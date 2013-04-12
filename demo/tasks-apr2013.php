<?php

require __DIR__ . '/../vendor/autoload.php';

use SeaPhp\Meetup\Apr2013\TaskManager;
use SeaPhp\Meetup\Apr2013\Task;
use SeaPhp\Meetup\Apr2013\EchoLogger;

$manager = new TaskManager(new EchoLogger());

$task1 = new Task('Task1');
$task2 = new Task('Task2');

$manager->addTask($task1);
$manager->addTask($task2);

$task1->setStatus(Task::STATUS_ASSIGNED);
$task2->setStatus(Task::STATUS_ASSIGNED);

$task1->setStatus(Task::STATUS_COMPLETE);
$task2->setStatus(Task::STATUS_COMPLETE);

$manager->removeTask($task1);
$manager->removeTask($task2);
