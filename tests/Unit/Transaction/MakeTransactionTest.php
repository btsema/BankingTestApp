<?php

namespace Tests\Unit\Transaction;

use App\Model\Country;
use App\Exceptions\InsufficientBalanceException;
use App\Services\Transaction\OptimisticLockingTransactionService;
use App\Model\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MakeTransactionTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIsNotExist()
    {
        factory(User::class)->create();

        $data = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(100)
            ->setType(1);

        try {
            resolve(OptimisticLockingTransactionService::class)->handle(2, $data);
        } catch (ModelNotFoundException $e) {
            $this->assertEquals($e->getMessage(), 'No query results for model [App\Model\User].');
        }
    }

    public function testUserHasNotHaveAmount()
    {
        $user = factory(User::class)->create([
            'balance' => 50,
        ]);

        $data = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(100)
            ->setType(0);

        try {
            resolve(OptimisticLockingTransactionService::class)->handle($user->id, $data);
        } catch (InsufficientBalanceException $e) {
            $this->assertEquals($e->getMessage(), 'You do not have enough money in your account');
        }
    }


    public function testRemoveAmount()
    {
        $user = factory(User::class)->create([
            'balance' => 50,
        ]);
        $country = factory(Country::class)->create();

        $data = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(25)
            ->setType(0)
            ->setCountryId($country->id);

        resolve(OptimisticLockingTransactionService::class)->handle($user->id, $data);

        $this->assertEquals($user->fresh()->balance, 25);
        $this->assertEquals($user->fresh()->count_transaction, 0);
    }

    public function testAddBonus()
    {
        $user = factory(User::class)->create([
            'balance' => 50,
            'count_transaction' => 2,
        ]);
        $country = factory(Country::class)->create();

        $data = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(25)
            ->setType(1)
            ->setCountryId($country->id);

        resolve(OptimisticLockingTransactionService::class)->handle($user->id, $data);

        $bonusAdded = $this->calculatePercentage($user->bonus_param, $data->getAmount());

        $this->assertEquals($user->fresh()->balance, 75);
        $this->assertEquals($user->fresh()->count_transaction, 3);
        $this->assertEquals($user->fresh()->bonus, $user->bonus + $bonusAdded);
    }

    public function testAddAmount()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create([
            'balance' => 40,
        ]);
        $country = factory(Country::class)->create();
        $data = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(100)
            ->setType(1)
            ->setCountryId($country->id);

        resolve(OptimisticLockingTransactionService::class)->handle($user->id, $data);

        $this->assertEquals($user->fresh()->balance, 140);
        $this->assertEquals($user->fresh()->count_transaction, 1);
    }

    /**
     * @param $percentage
     * @param $totalWidth
     * @return float|int
     */
    private function calculatePercentage($percentage, $totalWidth)
    {
        return ($percentage / 100) * $totalWidth;
    }
}
