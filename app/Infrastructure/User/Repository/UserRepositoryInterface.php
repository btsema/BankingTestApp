<?php
namespace App\Infrastructure\User\Repository;

interface UserRepositoryInterface
{
    public function getUserWhereIdOrThrowException(int $userId);
}
