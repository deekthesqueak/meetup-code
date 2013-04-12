<?php

namespace SeaPhp\Meetup\Apr2013;

class Task
{
    const STATUS_NEW      = 'NEW';
    const STATUS_ASSIGNED = 'ASSIGNED';
    const STATUS_COMPLETE = 'COMPLETE';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $status;

    /**
     * @var TaskManager
     */
    protected $manager;

    /**
     * @param string $name
     * @param string $status
     */
    public function __construct($name, $status = Task::STATUS_NEW)
    {
        if (!is_string($name) || !preg_match('/^[-0-9a-z_]{3,20}$/iD', $name)) {
            throw new \InvalidArgumentException('You must provide a valid name.');
        }

        $this->name = $name;
        $this->setStatus($status);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return self
     * @throws \InvalidArgumentException
     */
    public function setStatus($status)
    {
        if (!in_array($status, array(self::STATUS_NEW, self::STATUS_ASSIGNED, self::STATUS_COMPLETE), true)) {
            throw new \InvalidArgumentException('Status must be NEW, PENDING, or COMPLETE.');
        }

        $this->status = $status;

        if ($this->manager) {
            $this->manager->notifyStatusChange($this);
        }

        return $this;
    }

    /**
     * @param TaskManager $manager
     *
     * @return self
     */
    public function setTaskManager(TaskManager $manager)
    {
        $this->manager = $manager;

        return $this;
    }

    /**
     * @return self
     */
    public function removeTaskManager()
    {
        $this->manager = null;

        return $this;
    }
}
