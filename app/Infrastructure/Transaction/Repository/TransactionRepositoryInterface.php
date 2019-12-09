<?php


namespace App\Infrastructure\Transaction\Repository;


interface TransactionRepositoryInterface
{
    public function reportByTime($time);
}
