<?php
namespace App\Infrastructure\Transaction\Factory;

use App\Infrastructure\Transaction\Factory\TransactionFactory\UpdateObjectValue;

interface TransactionFactoryInterface
{
    public function store(UpdateObjectValue $updateObjectValue);
}
