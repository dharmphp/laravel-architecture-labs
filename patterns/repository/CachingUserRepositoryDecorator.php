<?php

namespace App\Repositories;

use Illuminate\Cache\CacheManager;

class CachingUserRepositoryDecorator implements UserRepositoryInterface
{
    protected $repository;
    protected $cache;
    protected $ttl = 60; // minutes

    public function __construct(UserRepositoryInterface $repository, CacheManager $cache)
    {
        $this->repository = $repository;
        $this->cache = $cache;
    }

    public function findById($id)
    {
        $key = "user.id.{$id}";
        return $this->cache->remember($key, $this->ttl, function () use ($id) {
            return $this->repository->findById($id);
        });
    }

    public function findByEmail($email)
    {
        $key = "user.email." . md5($email);
        return $this->cache->remember($key, $this->ttl, function () use ($email) {
            return $this->repository->findByEmail($email);
        });
    }

    public function getAllActive()
    {
        return $this->cache->remember('users.all_active', 15, function () {
            return $this->repository->getAllActive();
        });
    }

    public function create(array $attributes)
    {
        $user = $this->repository->create($attributes);
        $this->cache->forget('users.all_active');
        return $user;
    }
}
