<?php

namespace SeaPhp\Meetup\Apr2013;

class TaskManager implements \IteratorAggregate
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var \SplObjectStorage
     */
    protected $tasks;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
        $this->tasks = new \SplObjectStorage();
    }

    /**
     * @param Task $task
     *
     * @return self
     */
    public function addTask(Task $task)
    {
        $this->tasks->attach($task->setTaskManager($this));

        $this->logger->log('Added the task ' . $task->getName());

        return $this;
    }

    /**
     * @param Task $task
     *
     * @return self
     */
    public function removeTask(Task $task)
    {
        $this->tasks->detach($task->removeTaskManager());

        $this->logger->log('Removed the task ' . $task->getName());

        return $this;
    }

    /**
     * @param Task $task
     *
     * @return self
     */
    public function notifyStatusChange(Task $task)
    {
        $this->logger->log('Updated the status of task ' . $task->getName() . ' to ' . $task->getStatus());

        return $this;
    }

    /**
     * @return \SplObjectStorage
     */
    public function getIterator()
    {
        return $this->tasks;
    }
}
