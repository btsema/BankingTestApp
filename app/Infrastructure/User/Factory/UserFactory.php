<?php


namespace App\Infrastructure\User\Factory;


use App\Model\User;

class UserFactory implements UserFactoryInterface
{
    /**
     * @var User
     */
    private $user;

    /**
     * UserFactory constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }


    public function update($userId, $updatedAt, $data)
    {
        return $this->user::whereId($userId)
            ->where('updated_at', '=', $updatedAt)
            ->update($data);
    }
}
