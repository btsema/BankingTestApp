<?php

namespace App\Services\Transaction;

use App\Exceptions\InsufficientBalanceException;
use App\Infrastructure\Transaction\Factory\TransactionFactory\UpdateObjectValue;
use App\Infrastructure\Transaction\Factory\TransactionFactoryInterface;
use App\Infrastructure\User\Factory\UserFactoryInterface;
use App\Infrastructure\User\Repository\UserRepositoryInterface;
use App\Services\Transaction\OptimisticLockingTransactionService\TransactionServiceObjectValue;

class OptimisticLockingTransactionService
{
    private $user;
    private $userData = [
        'balance' => 0,
    ];

    /**
     * @var TransactionServiceObjectValue
     */
    private $data;
    /**
     * @var UserRepositoryInterface
     */
    private $userRepository;
    /**
     * @var UserFactoryInterface
     */
    private $userFactory;
    /**
     * @var TransactionFactoryInterface
     */
    private $transactionFactory;

    /**
     * TransactionOperation constructor.
     * @param UserRepositoryInterface $userRepository
     * @param UserFactoryInterface $userFactory
     * @param TransactionFactoryInterface $transactionFactory
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        UserFactoryInterface $userFactory,
        TransactionFactoryInterface $transactionFactory
    )
    {
        $this->userRepository = $userRepository;
        $this->userFactory = $userFactory;
        $this->transactionFactory = $transactionFactory;
    }

    /**
     * @param $userId
     * @param $data
     * @throws InsufficientBalanceException
     */
    public function handle($userId, TransactionServiceObjectValue $data)
    {
        $this->data = $data;

        do {
            $this->user = $this->userRepository->getUserWhereIdOrThrowException($userId);
            if (!$this->data->getType() && $this->user->balance < $this->data->getAmount()) {
                throw new InsufficientBalanceException('You do not have enough money in your account');
            }

            $this->calculateCorrectAmount($this->data->getType());
            $updated = $this->updateUser();
        } while (! $updated);

        $this->makeTransaction();
    }


    /**
     * Calculate correct amount that should be added in db
     * @param $type
     */
    private function calculateCorrectAmount($type)
    {
        if ($type) {
            $this->userData['balance'] = $this->user->balance + $this->data->getAmount();
            $this->userData['count_transaction'] = $this->user->count_transaction + 1;
            $this->isTransactionOrderIsThird();
            return;
        }

        $this->userData['balance'] = $this->user->balance - $this->data->getAmount();
    }

    /**
     * Check if current transaction is third in order for the current user
     */
    private function isTransactionOrderIsThird()
    {
        $divisible = $this->userData['count_transaction'] / 3;

        if ((int) $divisible === $divisible) {
            $this->userData['bonus'] = $this->calculateBonus();
        }
    }

    /**
     * Calculate a bonus amount
     */
    private function calculateBonus()
    {
        return $this->user->bonus + $this->calculatePercentageAmount($this->user->bonus_param, $this->data->getAmount());
    }

    /**
     * Update user data
     */
    private function updateUser()
    {
        return $this->userFactory->update($this->user->id, $this->user->updated_at, $this->userData);
    }

     /**
     * Make a transaction
     */
    private function makeTransaction()
    {
        $this->transactionFactory->store(
            (new UpdateObjectValue)
            ->setUserId($this->user->id)
            ->setCountryId($this->data->getCountryId())
            ->setAmount($this->data->getAmount())
            ->setType($this->data->getType())
        );
    }

    /**
     * @param $percentage
     * @param $totalWidth
     * @return float|int
     */
    private function calculatePercentageAmount($percentage, $totalWidth)
    {
        return ($percentage / 100) * $totalWidth;
    }
}
