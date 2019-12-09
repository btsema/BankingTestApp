<?php
namespace App\Infrastructure\User\Factory;

interface UserFactoryInterface
{
    public function update($userId, $updatedAt, $data);
}
