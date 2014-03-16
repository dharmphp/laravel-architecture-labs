<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function findById($id)
    {
        return User::find($id);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    public function getAllActive()
    {
        return User::where('is_active', 1)->orderBy('name')->get();
    }

    public function create(array $attributes)
    {
        return User::create($attributes);
    }
}
