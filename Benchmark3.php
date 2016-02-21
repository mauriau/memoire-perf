<?php

// php benchmarker by Paul Taulborg (njaguar at http://forums.d2jsp.org) - Modified by Jeroen Post


$timer = new benchmarkTimer();


$head = str_pad("#", 36, "#");

echo "<pre>" . str_pad(' PHP ' . PHP_VERSION . ' BENCHMARK ', 36, "#", STR_PAD_BOTH) . "\nStart : " . date("m/d/Y H:i:s a") . "\nServer : {$_SERVER['SERVER_NAME']}@{$_SERVER['SERVER_ADDR']}\nPlatform : " . PHP_OS . "\nPHP version: " . phpversion() . "\n$head\n";

$run_times = 1000000; // 1million
$run_times_slow_function = 10000; // 10 000

$string_1 = 'bob & jim & tim & kim & me & you are &&&& =%"';
$string_2 = '     what      ';
$string_3 = strtoupper($string_1);
$string_4 = '1234a';
$string_5 = '64x32';
$string_6 = 'this is a link to http://google.com which is a really popular site';
$string_7 = 'number %d is like a string %s that likes to hex %x it out';
$string_8 = $string_7 . ' and then some';
$string_9 = 'quotes\'are "fun" to use\'. Most of the time. \\ ya';

$array_1 = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' => 1, 'i' => 2, 'j' => 0);
$array_2 = array('coffee', 'brown', 'caffeine');

$time_1 = '12/29/2011 10:15:37pm';

$now = time();


$timer->start(memory_get_usage(true));
$a = memory_get_usage(true);
echo 'a='. $a . "\n";
for ($i = 0; $i < $run_times; ++$i)
    ;
echo 'peak = ' . memory_get_peak_usage(true) . "\n";

$timer->stop(memory_get_usage(true), 'for');
$b = memory_get_usage(true);
echo 'b = '. $b;
echo "\n" . $b-$a . "\n";
exit;

$timer->start(memory_get_usage(true));

while ($i > 0)
    --$i;

$timer->stop(memory_get_usage(true), 'while');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    $z = $i % 4;

    if ($z == 0) {
        
    } else if ($z == 1) {
        
    } else if ($z == 2) {
        
    } else {
        
    }
}

$timer->stop(memory_get_usage(true), 'if else');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    $z = $i % 4;

    switch ($z) {

        case 0: break;

        case 1: break;

        case 2: break;

        default: break;
    }
}

$timer->stop(memory_get_usage(true), 'switch');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    $z = ($i % 2 == 0 ? 1 : 0);
}

$timer->stop(memory_get_usage(true), 'Ternary');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    str_replace('&', '&amp;', $string_1);

$timer->stop(memory_get_usage(true), 'str_replace');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times_slow_function; $i++)
    preg_replace("#(^|\s)(http[s]?://\w+[^\s\[\]\<]+)#i", '\1<a href="\2">\2</a>', $string_6);

$timer->stop(memory_get_usage(true), 'preg_replace');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    preg_match("#http[s]?://\w+[^\s\[\]\<]+#", $string_6);

$timer->stop(memory_get_usage(true), 'preg_match');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    count($array_1);

$timer->stop(memory_get_usage(true), 'count');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    isset($array_1['i']);

    isset($array_1['zzNozz']);
}

$timer->stop(memory_get_usage(true), 'isset');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    time();

$timer->stop(memory_get_usage(true), 'time');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    strlen($string_1);

$timer->stop(memory_get_usage(true), 'strlen');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    sprintf($string_7, $i, $string_5, $i);

$timer->stop(memory_get_usage(true), 'sprintf');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    strcmp($string_7, $string_8);

$timer->stop(memory_get_usage(true), 'strcmp');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    trim($string_2);

$timer->stop(memory_get_usage(true), 'trim');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times_slow_function; $i++)
    explode('&', $string_1);

$timer->stop(memory_get_usage(true), 'explode');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    implode('&', $array_1);

$timer->stop(memory_get_usage(true), 'implode');



$f1 = $timer->totalTime;

$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    number_format($f1, 3);

$timer->stop(memory_get_usage(true), 'number_format');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    floor($f1);

$timer->stop(memory_get_usage(true), 'floor');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    strpos($string_2, 't');

$timer->stop(memory_get_usage(true), 'strpos');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    substr($string_1, 10);

$timer->stop(memory_get_usage(true), 'substr');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    intval($string_4);

$timer->stop(memory_get_usage(true), 'intval');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    (int) $string_4;

$timer->stop(memory_get_usage(true), '(int)');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    is_array($array_1);

    is_array($string_1);
}

$timer->stop(memory_get_usage(true), 'is_array');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    is_numeric($f1);

    is_numeric($string_4);
}

$timer->stop(memory_get_usage(true), 'is_numeric');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    is_int($f1);

    is_int($string_4);
}

$timer->stop(memory_get_usage(true), 'is_int');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    is_string($f1);

    is_string($string_4);
}

$timer->stop(memory_get_usage(true), 'is_string');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    ip2long('1.2.3.4');

$timer->stop(memory_get_usage(true), 'ip2long');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    long2ip(89851921);

$timer->stop(memory_get_usage(true), 'long2ip');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times_slow_function; $i++)
    date('F j, Y, g:i a', $now);

$timer->stop(memory_get_usage(true), 'date');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times_slow_function; $i++)
    strftime('%B %e, %Y, %l:%M %P', $now);

$timer->stop(memory_get_usage(true), 'strftime');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times_slow_function; $i++)
    strtotime($time_1);

$timer->stop(memory_get_usage(true), 'strtotime');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    strtolower($string_3);

$timer->stop(memory_get_usage(true), 'strtolower');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    strtoupper($string_1);

$timer->stop(memory_get_usage(true), 'strtoupper');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    md5($string_1);

$timer->stop(memory_get_usage(true), 'md5');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++) {

    unset($array_1['j']);

    $array_1['j'] = 0;
}

$timer->stop(memory_get_usage(true), 'unset');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    list($drink, $run_timesolor, $power) = $array_2;

$timer->stop(memory_get_usage(true), 'list');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    urlencode($string_1);

$timer->stop(memory_get_usage(true), 'urlencode');



$string_1e = urlencode($string_1);

$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    urldecode($string_1e);

$timer->stop(memory_get_usage(true), 'urldecode');



$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    addslashes($string_9);

$timer->stop(memory_get_usage(true), 'addslashes');



$string_9e = addslashes($string_9);

$timer->start(memory_get_usage(true));

for ($i = 0; $i < $run_times; $i++)
    stripslashes($string_9e);

$timer->stop(memory_get_usage(true), 'stripslashes');
echo $head . "\n" . str_pad("Total", 23) . " : " . number_format($timer->totalTime, 3) . " sec</pre>\n";
echo $head . "\n" . $timer->convert($timer->totalMemory);

exit; // all done

class benchmarkTimer
{

    public $startTime;
    public $startMemory;
    public $totalMemory = 0;
    public $totalTime = 0;

    public function start($memory)
    {
        // use this method, because old php 4.x branches do not support the parameter to return a float
        list($usec, $this->string_ec) = explode(" ", microtime());

        $this->startTime = ((float) $usec + (float) $this->string_ec);
        $this->startMemory = $memory;
        echo "start " . $this->startMemory . " \n";
    }

    public function stop($memory, $time_itle)
    {
//        $memory = memory_get_usage(true);

        list($usec, $string_ec) = explode(" ", microtime());
        $time = ((float) $usec + (float) $string_ec) - $this->startTime;
        echo str_pad($time_itle, 23) . " : " . number_format($time, 5) . " sec et ";
        $this->totalTime += $time;
        unset($time, $usec, $string_ec);
        $delta = $memory - $this->startMemory;
        echo $this->convert($delta);
        $this->totalMemory +=memory_get_usage();
        unset($this->startMemory);
    }

    public function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i] . "\n";
    }

}
