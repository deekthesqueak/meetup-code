<?php

namespace SeaPhp\Meetup\Apr2013;

class Math
{
    public static function factorial($num)
    {
        if (!is_int($num) || $num < 0) {
            throw new \InvalidArgumentException('You must provide a non-negative integer.');
        } elseif ($num === 0) {
            return 1;
        } else {
            return self::factorial($num - 1) * $num;
        }
    }
}
