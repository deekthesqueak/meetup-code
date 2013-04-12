<?php

namespace SeaPhp\Meetup\Apr2013;

class FileLogger implements LoggerInterface
{
    /**
     * @var \SplFileObject
     */
    protected $file;

    /**
     * @param \SplFileObject|string $file
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($file)
    {
        if ($file instanceof \SplFileObject) {
            $this->file = $file;
        } elseif (is_string($file)) {
            $this->file = new \SplFileObject($file, 'a');
        } else {
            throw new \InvalidArgumentException('You must provide a valid file.');
        }
    }

    /**
     * @param string $message
     */
    public function log($message)
    {
        $this->file->fwrite(date('c') . ' - ' . $message . PHP_EOL);
    }
}
