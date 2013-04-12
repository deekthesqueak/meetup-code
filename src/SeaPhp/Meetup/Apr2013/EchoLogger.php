<?php

namespace SeaPhp\Meetup\Apr2013;

class EchoLogger implements LoggerInterface
{
    /**
     * @param string $message
     */
    public function log($message)
    {
        echo date('c') . ' - ' . $message . PHP_EOL;
    }
}
