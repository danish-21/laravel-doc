<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Models\User;
use App\Models\UserOtp;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Ramsey\Uuid\Uuid;


class AuthController extends BaseController
{
    public function resendOtp(Request $request)
    {
        $email = $request->json('email');

        $user = User::where('email', $email)->first();

        if (!$user) {
            throw new BadRequestHttpException(__('User not found'));
        }

        $otp = rand(100000, 999999);

        $userOtp = UserOtp::where('user_id', $user->id)->first();
        if ($userOtp) {
            $uuid = Uuid::uuid4();
            $userOtp->otp = $otp;
            $userOtp->uuid = $uuid;
            $userOtp->expires_at = Carbon::now()->addMinutes(10);
            $userOtp->save();
        } else {
            $uuid = Uuid::uuid4();
            $userOtp = UserOtp::create([
                'user_id' => $user->id,
                'otp' => $otp,
                'expires_at' => Carbon::now()->addMinutes(10),
                'uuid' => $uuid
            ]);
        }

//        (new \App\Mail\SendOtp)->reSendLoginOtp($user, $userOtp);

        return [
            "uuid" => $uuid,
            "success_message" => "OTP has been successfully sent to your email ID. It is valid for only 10 minutes."];


    }

    public function doLogin(Request $request)
    {
        $email = $request->json('email');
        $password = $request->json('password');
        $otp = $request->json('otp');
        $uuid = $request->json('uuid');

        if (isset($email) && isset($password)) {
            $user = User::where('email', $email)->first();
            if (is_null($user)) {
                throw new AppException('Email not register');
            }

            if ($user->email != $email) {
                throw new AppException('Please Enter a valid Email');
            } else {
                $credentials = ['email' => $email, 'password' => $password];
            }

            if (!Auth::attempt($credentials)) {
                throw new AppException(__('Invalid Credentials'), 401);
            }

            if ($user->is_active === false) {
                throw new BadRequestHttpException(__('User is not active'));
            }
//            dd($user->createToken('*')->accessToken);

            $result = ['user' => $user, 'token' => $user->createToken('invoice')->accessToken];
            return $this->standardResponse($result, 'User logged in successfully', 'success', 200);
        }


        if (isset($email)) {
            $user = User::where('email', $email)->first();
            if (is_null($user)) {
                throw new AppException('Email is not registered, please Sign up first.');
            }
            $otp = rand(100000, 999999);

            $userOtp = UserOtp::where('user_id', $user->id)->first();
            if ($userOtp) {
                $uuid = Uuid::uuid4();
                $userOtp->otp = $otp;
                $userOtp->uuid = $uuid;
                $userOtp->expires_at = Carbon::now()->addMinutes(10);
                $userOtp->save();
            } else {
                $uuid = Uuid::uuid4();
                $userOtp = UserOtp::create([
                    'user_id' => $user->id,
                    'otp' => $otp,
                    'expires_at' => Carbon::now()->addMinutes(10),
                    'uuid' => $uuid
                ]);
            }
            $user->save();

//            (new \App\Mail\SendOtp)->sendLoginOtp($user, $userOtp);

            return [
                "uuid" => $uuid,
                "success_message" => "OTP has been successfully sent to your email ID. It is valid for only 10 minutes."];
        }

        if (isset($uuid) && isset($otp)) {
            $user = UserOtp::where('uuid', $uuid)->first();

            if (is_null($user)) {
                throw new AppException("Your OTP is expired please request for resend OTP");
            }

            $userOtp = UserOtp::where('user_id', $user->user_id)->first();
            $user = User::where('id', $user->user_id)->first();

            if ($user->is_active === false) {
                throw new BadRequestHttpException(__('User is not active'));
            }
            if ($userOtp->otp == $otp) {
                if (Carbon::now() < $userOtp->expires_at) {
                    $user->verification_status = 1;
                    $user->save();
                    $result = ['user' => $user, 'token' => $user->createToken('invoice')->accessToken];
                    return $this->standardResponse($result, 'User logged in successfully', 'success', 200);
                } else {
                    throw new AppException('Your OTP has been expired');
                }
            } else {
                throw new AppException('Invalid OTP, enter correct OTP');
            }
        }

    }
    public function changePassword(Request $request)
    {
        $userId = Auth::id();
        $user = User::find($userId);

        if (is_null($user)) {
            throw new AppException('You are not LoggedIn');
        }

        if ($request->has('otp') && $request->has('password')) {
            $userOtp = UserOtp::where('user_id', $userId)->first();

            if ($userOtp->otp == $request->input('otp')) {
                if (Carbon::now() < $userOtp->expires_at) {
                    $password = $request->input('password');
                    $user->update(['password' => Hash::make($password)]);
                    return $this->standardResponse(null, 'Your password is updated successfully', 'success', 200);
                } else {
                    throw new AppException('Your OTP has expired');
                }
            } else {
                throw new AppException('Invalid OTP, please enter the correct OTP');
            }
        }

        $otp = rand(100000, 999999);

        $userOtp = UserOtp::where('user_id', $user->id)->first();
        if ($userOtp) {
            $uuid = Uuid::uuid4();
            $userOtp->otp = $otp;
            $userOtp->uuid = $uuid;
            $userOtp->expires_at = Carbon::now()->addMinutes(10);
            $userOtp->save();
        }
//        (new SendOtp)->sendOTPForPasswordChange($user, $userOtp);

        return $this->standardResponse(null, 'OTP sent successfully', 'success', 200);

    }


}
