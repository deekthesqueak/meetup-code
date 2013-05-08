<?php

require __DIR__ . '/../vendor/autoload.php';

use SeaPhp\May2013\Account;
use SeaPhp\May2013\AccountNotifier;
use SeaPhp\May2013\Transaction;

$account = new Account('Z4G2J0L1', 500);
$account->attach(new AccountNotifier(\DateTime::ISO8601));

$account->withdraw(150);
$account->withdraw(70);
$account->deposit(300);
$account->withdraw(20);

printf("Account Balance: $%d\n", $account->getBalance());
