<?php

class Generate
{
    public static function RandomString($length)
{
    $pieces = [];
    $keyspace = "abcdefghijklmnopqrstuvwxyz1234567890";
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}
}
?>