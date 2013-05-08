<?php

namespace SeaPhp\May2013;

class Account implements \SplSubject
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var integer
     */
    protected $balance;

    /**
     * @var bool
     */
    protected $open;

    /**
     * @var \SplStack
     */
    protected $transactions;

    /**
     * @var \SplObjectStorage
     */
    protected $observers;

    /**
     * @param     $id
     * @param int $balance
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($id, $balance = 0)
    {
        if (!is_string($id) || !preg_match('/^[A-Z][0-9A-Z]{7}$/', $id)) {
            throw new \InvalidArgumentException();
        }

        if (!is_int($balance)) {
            throw new \InvalidArgumentException();
        }

        $this->id = $id;
        $this->balance = $balance;
        $this->transactions = new \SplStack();
        $this->observers = new \SplObjectStorage();
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return Transaction
     */
    public function getLatestTransaction()
    {
        return $this->transactions->top();
    }

    /**
     * @param $amount
     *
     * @throws \InvalidArgumentException
     */
    public function withdraw($amount)
    {
        if (!is_int($amount)) {
            throw new \InvalidArgumentException();
        }

        $amount = abs($amount);
        $this->balance -= $amount;
        $this->transactions->push(new Transaction(Transaction::TYPE_WITHDRAWAL, $amount));
        $this->notify();
    }

    /**
     * @param $amount
     *
     * @throws \InvalidArgumentException
     */
    public function deposit($amount)
    {
        if (!is_int($amount)) {
            throw new \InvalidArgumentException();
        }

        $amount = abs($amount);
        $this->balance += $amount;
        $this->transactions->push(new Transaction(Transaction::TYPE_DEPOSIT, $amount));
        $this->notify();
    }

    /**
     * @param \SplObserver $observer
     */
    public function attach(\SplObserver $observer)
    {
        $this->observers->attach($observer);
    }

    /**
     * @param \SplObserver $observer
     */
    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        /** @var $observer \SplObserver */
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
