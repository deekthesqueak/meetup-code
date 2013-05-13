<?php

namespace SeaPhp\May2013\Test;

use SeaPhp\May2013\AccountNotifier;

class AccountNotifierTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \UnexpectedValueException
     */
    public function testInvalidMessageFormatType()
    {
        $method = new \ReflectionMethod('SeaPhp\May2013\AccountNotifier', 'getMessageFormat');
        $method->setAccessible(true);
        $method->invoke(new AccountNotifier(), 'badString');
    }

    public function testValidWithdrawalMessageFormat()
    {
        $method = new \ReflectionMethod('SeaPhp\May2013\AccountNotifier', 'getMessageFormat');
        $method->setAccessible(true);
        $this->assertEquals($method->invoke(new AccountNotifier(), 'withdrawal'), 
            'There was a withdrawal of $:amount from account #:id at :date.');
    }

    public function testValidDespositMessageFormat()
    {
        $method = new \ReflectionMethod('SeaPhp\May2013\AccountNotifier', 'getMessageFormat');
        $method->setAccessible(true);
        $this->assertEquals($method->invoke(new AccountNotifier(), 'deposit'), 
            'There was a deposit of $:amount to account #:id at :date.');
    }
}