<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function findById($id);
    public function findByEmail($email);
    public function getAllActive();
    public function create(array $attributes);
}
