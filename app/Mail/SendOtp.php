<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class SendOtp extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * CreateDemandRequest a new message instance.
     *
     * @return void
     */

    /**
     * Build the message.
     *
     * @return $this
     */
    public function sendSignupOTP($user,$userOtp)
    {

        Mail::send('User.SendSignupOtp', ['user' => $user, 'otp' => $userOtp], function ($message) use ($user,$userOtp) {

                $message->from(env('MAIL_USERNAME'), 'Reza');
                $message->subject('Your Signup verification One-Time Password (OTP)');
                $message->to($user->email);
        });

    }

    public function sendLoginOtp($user,$userOtp)
    {

        Mail::send('User.SendLoginOtp', ['user' => $user, 'otp' => $userOtp], function ($message) use ($user,$userOtp) {

            $message->from(env('MAIL_USERNAME'));
            $message->subject('Your Login Verification One Time Password (OTP)');
            $message->to($user->email);
        });

    }

    public function reSendLoginOtp($user,$userOtp)
    {

        Mail::send('User.SendLoginOtp', ['user' => $user, 'otp' => $userOtp], function ($message) use ($user,$userOtp) {

            $message->from(env('MAIL_USERNAME'), 'Reza');
            $message->subject('Your resend verification One-Time Password (OTP)');
            $message->to($user->email);
        });

    }

    public function sendOTPForPasswordChange($user,$userOtp)
    {

        Mail::send('User.PasswordChange', ['user' => $user, 'otp' => $userOtp], function ($message) use ($user,$userOtp) {

            $message->from(env('MAIL_USERNAME'), 'Reza');
            $message->subject('Your Change Password verification One-Time Password (OTP) ');
            $message->to($user->email);
        });

    }


}
