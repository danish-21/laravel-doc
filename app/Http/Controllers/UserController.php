<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\User\UserAddressRequest;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends BaseController
{
    public function self()
    {
        $userId = Auth::id();

        if (!$userId) {
            return $this->standardResponse('User not found', null,  null,404);
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->standardResponse('User not found', null,  null,404);
        }

        return $this->standardResponse('User retrieved successfully', $user, null, 200);
    }
    public function createUser(CreateUserRequest $request)
    {
        try {
            $validatedData = $request->validated();

            $name = $validatedData['name'];
            $phone = $validatedData['phone'];
            $email = $validatedData['email'];
            $password = $validatedData['password'];

            // Create a new User instance
            $user = new User();
            $user->name = $name;
            $user->phone = $phone;
            $user->email = $email;
            $user->password = bcrypt($password);
            $user->is_active = true;
            $user->verification_status = false;

            // Save the user to the database
            $user->save();

            // Return a response indicating success or any additional data you need
            return ResponseHelper::createOrUpdateResponse($user);
        } catch (\Exception $exception) {
            return $this->standardResponse($exception->getMessage(), null,  null,400);
        }
    }


    public function index()
    {
        $users = User::with('user_otps')->paginate();

        return ResponseHelper::paginationResponse($users);

    }
    public function destroy($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                throw new AppException('User not found');
            }

            if ($user->id === Auth::user()->id) {
                throw new AppException('You are not allowed to delete your own account');
            }

            $user->delete();

            return ResponseHelper::deleteResponse($user);
        } catch (AppException $exception) {
            return $this->standardResponse($exception->getMessage(), null,  null,400);
        }
    }

    /**
     * @param UpdateUserRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateUser(UpdateUserRequest $request, $id)
    {
        try {
            $validatedData = $request->validated();

            $user = User::findOrFail($id);
            $user->name = $validatedData['name'] ?? $user->name;
            $user->phone = $validatedData['phone'] ?? $user->phone;
            $user->email = $validatedData['email'] ?? $user->email;

            // Save the updated user to the database
            $user->save();

            // Return a response indicating success or any additional data you need
            ResponseHelper::createOrUpdateResponse($user);
        } catch (ValidationException $exception) {
            return response()->json(['errors' => $exception->errors()], 422);
        }catch (AppException $exception) {
            return $this->standardResponse($exception->getMessage(), 'User not found', null, 400);
        }
    }
    public function createUserAddress(UserAddressRequest $request) {
        $user = Auth::id();
        if (is_null($user)) {
            throw new  AppException('Please Login', 400);
        }
        $validatedData = $request->validated();
//        dd($validatedData);


        $user_address = new UserAddress();
        $user_address->user_id = $user;
        $user_address->address = $validatedData['address'];
        $user_address->zipcode = $validatedData['zipcode'];
        $user_address->phone = $validatedData['phone'];
        $user_address->building = $validatedData['building'];
        $user_address->street = $validatedData['street'];
        $user_address->area = $validatedData['area'];
        $user_address->state = $validatedData['state'];
        $user_address->country = $validatedData['country'];
        $user_address->city = $validatedData['city'];
        $user_address->save();
        return $this->standardResponse('User Address Create Successfully',$user_address);

    }

}
