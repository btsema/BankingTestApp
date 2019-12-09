<?php


namespace App\Infrastructure\Transaction\Factory;


use App\Services\Transaction\OptimisticLockingTransactionService;
use App\Infrastructure\Transaction\Factory\TransactionFactory\UpdateObjectValue;
use App\Model\Transaction;

class TransactionFactory implements TransactionFactoryInterface
{
    public function store(UpdateObjectValue $updateObjectValue)
    {
        $transaction = new Transaction();
        $transaction->country_id = $updateObjectValue->getCountryId();
        $transaction->user_id = $updateObjectValue->getUserId();
        $transaction->amount = $updateObjectValue->getAmount();
        $transaction->type = $updateObjectValue->getType();
        $transaction->save();
    }
}
