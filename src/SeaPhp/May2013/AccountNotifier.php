<?php

namespace SeaPhp\May2013;

class AccountNotifier implements \SplObserver
{
    /**
     * @var string
     */
    protected $dateFormat;

    /**
     * @param string $dateFormat
     */
    public function __construct($dateFormat = 'Y-m-d H:i:s')
    {
        $this->dateFormat = $dateFormat;
    }

    /**
     * @param \SplSubject $subject
     */
    public function update(\SplSubject $subject)
    {
        /** @var $account Account */
        $account = $subject;

        /** @var $transaction Transaction */
        if ($transaction = $account->getLatestTransaction()) {
            echo strtr($this->getMessageFormat($transaction->getType()), array(
                ':id'     => $account->getId(),
                ':amount' => $transaction->getAmount(),
                ':date'   => date($this->dateFormat, $transaction->getTime()),
            ));
            echo PHP_EOL;
        }
    }

    /**
     * @param string $type
     *
     * @return string
     * @throws \UnexpectedValueException
     */
    protected function getMessageFormat($type)
    {
        switch ($type) {
            case Transaction::TYPE_WITHDRAWAL:
                $format = 'There was a withdrawal of $:amount from account #:id at :date.';
                break;
            case Transaction::TYPE_DEPOSIT:
                $format = 'There was a deposit of $:amount to account #:id at :date.';
                break;
            default:
                throw new \UnexpectedValueException("The transaction type {$type} does not have a message format.");
        }

        return $format;
    }
}
