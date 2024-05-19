<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use App\Enum\RoleStatus;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseHandler;

    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user = $this->userRepository->getPaginate();

        return $this->responseSuccess(200, $user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request): JsonResponse
    {
        try {
            $user = $this->userRepository->create([
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'role_id' => RoleStatus::MANAGER->value,
                'created_at' => Carbon::now(),
            ]);

            return $this->responseSuccess(201, $user);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while creating the user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {

        return $this->responseSuccess(200, $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $user = $this->userRepository->update($user->id, [
                'name' => $request->name,
                'email' => $request->email,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'tel' => $request->tel,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'role_id' => RoleStatus::MANAGER->value,
            ]);

            return $this->responseSuccess(200, $user);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while updating the user.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $this->userRepository->delete($user->id);

            return $this->responseSuccess(200, null);
        } catch (\Exception $e) {

            return $this->responseError(500, 'INTERNAL_ERROR', 'An error occurred while deleting the user.');
        }
    }
}
