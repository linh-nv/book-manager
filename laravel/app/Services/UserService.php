<?php

namespace App\Services;

use App\Enum\RoleStatus;
use App\Models\User;
use App\Repositories\User\UserRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getPaginate(?string $keyword = null)
    {
        return $keyword ? $this->userRepository->search($keyword) : $this->userRepository->getPaginate();
    }

    public function createUser(array $data): User
    {
        return $this->userRepository->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'tel' => $data['tel'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'role_id' => RoleStatus::MANAGER->value,
        ]);
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->find($id);
    }

    public function updateUser(int $id, array $data): User
    {
        return $this->userRepository->update( $id, [
            'name' => $data['name'],
            'email' => $data['email'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
            'tel' => $data['tel'],
            'birthday' => $data['birthday'],
            'gender' => $data['gender'],
            'role_id' => RoleStatus::MANAGER->value,
        ]);
    }

    public function deleteUser(int $id): bool
    {

        return $this->userRepository->delete($id);
    }
}
