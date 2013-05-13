<?php

namespace SeaPhp\May2013\Test;

use SeaPhp\May2013\Account;
use SeaPhp\May2013\AccountNotifier;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorInvalidId()
    {
        $account = new Account('badString');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructorInvalidBalace()
    {
        $account = new Account('A1234567', 'badString');
    }

    public function testGetId()
    {
        $account = new Account('A1234567', 1000);
        $this->assertEquals($account->getId(), 'A1234567');
    }

    public function testGetBalance()
    {
        $account = new Account('A1234567', 1000);
        $this->assertEquals($account->getBalance(), 1000);
    }

    public function testGetLastTransaction()
    {
        $account = new Account('A1234567', 1000);
        $account->deposit(500);
        $latestTransaction = $account->getLatestTransaction();
        $this->assertObjectHasAttribute('type', $latestTransaction);
        $this->assertObjectHasAttribute('time', $latestTransaction);
        $this->assertObjectHasAttribute('amount', $latestTransaction);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testNoTransactionsExecption()
    {
        $account = new Account('A1234567', 1000);
        $account->getLatestTransaction();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidWithdrawAmount()
    {
        $account = new Account('A1234567', 1000);
        $account->withdraw('badString');
    }

    public function testValidWithdrawAmount()
    {
        $account = new Account('A1234567', 1000);
        $account->withdraw(500);
        $this->assertEquals($account->getBalance(), 500);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidDeposit()
    {
        $account = new Account('A1234567', 1000);
        $account->deposit('badString');
    }

    public function testValidDeposit()
    {
        $account = new Account('A1234567', 1000);
        $account->deposit(1000);
        $this->assertEquals($account->getBalance(), 2000);
    }

    public function testAccountAttach()
    {
        $account = new Account('A1234567', 1000);
        $mockAccountNotifier = $this->getMock('\SplObserver');
        $account->attach($mockAccountNotifier);
    }

    public function testAccountDetatch()
    {
        $account = new Account('A1234567', 1000);
        $mockAccountNotifier = $this->getMock('\SplObserver');
        $account->detach($mockAccountNotifier);
    }

    public function testNotifySingleObserverOnDeposit()
    {
        $account = new Account('A1234567', 1000);
        $mockAccountNotifier = $this->getMock('\SplObserver');
        $account->attach($mockAccountNotifier);
        $account->deposit(500);
    }
}