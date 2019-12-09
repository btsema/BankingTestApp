<?php

namespace Tests\Unit\Transaction;

use App\Model\Country;
use App\Model\Transaction;
use App\Services\Transaction\OptimisticLockingTransactionService;
use App\Model\User;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UpdateUserInSameTimeTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateInSameTime()
    {
        $user = factory(User::class)->create();
        $country1 = factory(Country::class)->create();
        $country2 = factory(Country::class)->create();
        $data1 = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(100)
            ->setType(1)
            ->setCountryId($country1->id);

        $data2 = (new OptimisticLockingTransactionService\TransactionServiceObjectValue())
            ->setAmount(40)
            ->setType(1)
            ->setCountryId($country2->id);

        DB::beginTransaction();

        resolve(OptimisticLockingTransactionService::class)->handle($user->id, $data1);
        resolve(OptimisticLockingTransactionService::class)->handle($user->id, $data2);

        DB::commit();

        $freshUser = $user->fresh();

        $this->assertEquals($freshUser->balance, 140);
        $this->assertEquals($freshUser->count_transaction, 2);
        $this->assertEquals(Transaction::all()->count(), 2);
    }
}
