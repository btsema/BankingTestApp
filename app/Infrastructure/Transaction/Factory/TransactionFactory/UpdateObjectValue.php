<?php


namespace App\Infrastructure\Transaction\Factory\TransactionFactory;


class UpdateObjectValue
{
    private $country_id;
    private $amount;
    private $type;
    private $user_id;

    /**
     * @param int $country_id
     * @return UpdateObjectValue
     */
    public function setCountryId(int $country_id)
    {
        $this->country_id = $country_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountryId()
    {
        return $this->country_id;
    }

    /**
     * @param int $amount
     * @return UpdateObjectValue
     */
    public function setAmount(int $amount)
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $type
     * @return UpdateObjectValue
     */
    public function setType(int $type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $user_id
     * @return UpdateObjectValue
     */
    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
