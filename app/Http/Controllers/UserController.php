<?php

namespace App\Http\Controllers;

use App\Exceptions\AppException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\CreateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends BaseController
{
    public function self()
    {
        $userId = Auth::id();

        if (!$userId) {
            return $this->standardResponse('User not found', null, 'error', 404);
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->standardResponse('User not found', null, 'error', 404);
        }

        return $this->standardResponse('User retrieved successfully', $user, 'success', 200);
    }
    public function createUser(Request $request)
    {
        try {
            $validatedData = $request->all();

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
            return response()->json(['message' => 'User created successfully', 'items' => $user], 200);
        } catch (ValidationException $exception) {
            return response()->json(['errors' => $exception->errors()], 422);
        }
    }


    public function index()
    {
        $users = User::with('user_otps')->paginate();

        $response = ResponseHelper::paginationResponse($users->items(), [
            'page' => $users->currentPage(),
            'total' => $users->total(),
            'pages' => $users->lastPage(),
            'perPage' => $users->perPage(),
        ]);

        return response()->json($response, 200);
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

            return $this->standardResponse('User deleted successfully', $user, 'success', 200);
        } catch (AppException $exception) {
            return $this->standardResponse($exception->getMessage(), null, 'error', 400);
        }
    }

}
