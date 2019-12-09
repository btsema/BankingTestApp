<?php
namespace App\Services\Transaction\OptimisticLockingTransactionService;


class TransactionServiceObjectValue
{
    private $country_id;
    private $amount;
    private $type;

    public function setCountryId(int $country_id)
    {
        $this->country_id = $country_id;
        return $this;
    }

    public function getCountryId()
    {
        return $this->country_id;
    }

    public function setAmount(int $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setType(int $type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }
}
