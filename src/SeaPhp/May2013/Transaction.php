<?php

namespace SeaPhp\May2013;

class Transaction
{
    const TYPE_WITHDRAWAL = 'withdrawal';
    const TYPE_DEPOSIT    = 'deposit';

    /**
     * @var string
     */
    protected $type;

    /**
     * @var integer
     */
    protected $time;

    /**
     * @var integer
     */
    protected $amount;

    /**
     * @param string   $type
     * @param int      $amount
     * @param int|null $time
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($type, $amount = 0, $time = null)
    {
        static $validTypes = array(self::TYPE_WITHDRAWAL, self::TYPE_DEPOSIT);

        if (!in_array($type, $validTypes)) {
            throw new \InvalidArgumentException();
        }
        $this->type = $type;

        if (!is_int($amount) || $amount < 0) {
            throw new \InvalidArgumentException();
        }
        $this->amount = $amount;

        $this->time = is_int($time) ? $time : time();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }
}
