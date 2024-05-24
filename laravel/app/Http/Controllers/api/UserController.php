<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseHandler;
use App\Enum\RoleStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;

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

        return $this->responseSuccess(Response::HTTP_OK, $user);
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

            return $this->responseSuccess(Response::HTTP_CREATED, $user);
        } catch (\Exception $e) {
            
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while creating the user.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {

        return $this->responseSuccess(Response::HTTP_OK, $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user): JsonResponse
    {
        try {
            $user = $this->userRepository->find($user->id);

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

            return $this->responseSuccess(Response::HTTP_OK, $user);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while updating the user.');
        }
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        try {
            $user = $this->userRepository->find($user->id);

            $this->userRepository->delete($user->id);

            return $this->responseSuccess(Response::HTTP_OK, null);
        } catch (\Exception $e) {

            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while deleting the user.');
        }
    }

    public function search(Request $request): JsonResponse
    {
        $keyword = $request->keyword;

        if (!$keyword) {
            return $this->responseError(Response::HTTP_BAD_REQUEST, 'BAD_REQUEST', 'Keyword is required for search.');
        }

        try {
            $results = $this->userRepository->search($keyword);
            if ($results->isEmpty()) {
                return $this->responseError(Response::HTTP_NOT_FOUND, 'NOT_FOUND', 'No users found matching the search criteria.');
            }
            return $this->responseSuccess(Response::HTTP_OK, $results);
        } catch (\Exception $e) {
            return $this->responseError(Response::HTTP_INTERNAL_SERVER_ERROR, 'INTERNAL_ERROR', 'An error occurred while searching for users.');
        }
    }
}
