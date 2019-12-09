<?php
namespace App\Infrastructure\User\Repository;

use App\Model\User;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUserWhereIdOrThrowException(int $userId)
    {
        return $this->user::whereId($userId)->firstOrFail();
    }
}
