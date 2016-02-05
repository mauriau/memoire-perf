<?php

// php benchmarker by Paul Taulborg (njaguar at http://forums.d2jsp.org) - Modified by Jeroen Post

class BenchmarkTimer
{

    public $startTime;
    public $startMemory;
    public $totalMemory = 0;
    public $totalTime = 0;
    public $run_times = 1000000; // 1million
    public $run_times_slow_function = 10000; // 10 000
    public $string_1 = 'bob & jim & tim & kim & me & you are &&&& =%"';
    public $string_2 = '     what      ';
    public $string_3;
    public $string_4 = '1234a';
    public $string_5 = '64x32';
    public $string_6 = 'this is a link to http://google.com which is a really popular site';
    public $string_7 = 'number %d is like a string %s that likes to hex %x it out';
    public $string_8;
    public $string_9 = 'quotes\'are "fun" to use\'. Most of the time. \\ ya';
    public $array_1 = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h' => 1, 'i' => 2, 'j' => 0);
    public $array_2 = array('coffee', 'brown', 'caffeine');
    public $time_1 = '12/29/2011 10:15:37pm';
    public $now;

    public function __construct()
    {
        $head = str_pad("#", 36, "#");
        echo "<pre>" . str_pad(' PHP ' . PHP_VERSION . ' BENCHMARK ', 36, "#", STR_PAD_BOTH) . "\nStart : " . date("m/d/Y H:i:s a") . "\nServer : {$_SERVER['SERVER_NAME']}@{$_SERVER['SERVER_ADDR']}\nPlatform : " . PHP_OS . "\nPHP version: " . phpversion() . "\n$head\n";

        $this->string_3 = strtoupper($this->string_1);
        $this->string_8 = $this->string_7 . ' and then some';
        $this->now = time();
        $methods = get_class_methods($this);
        unset($methods[0], $methods[1], $methods[2], $methods[3]);
        $methods = array_values($methods);
        foreach ($methods as $key => $method) {
            $this->$method();
        }
//        $test = [
//            $methods[0],
//            $methods[1],
//            $methods[2],
//            $methods[3],
//            $methods[4],
//            $methods[5],
//            $methods[6],
//        ];
//        foreach ($test as $key => $method) {
//            $this->$method();
//            $this->$methods[$key]();
//        }
//        for ($i = 0; $i < 5; $i++) {
//            $this->$methods[$i]();
//        }
        echo $head . "\n" . str_pad("Total", 23) . " : " . number_format($this->totalTime, 3) . " sec</pre>\n";
        echo $head . "\n" . $this->convert($this->totalMemory);
    }

    protected function start()
    {
// use this method, because old php 4.x branches do not support the parameter to return a float
        list($usec, $this->string_ec) = explode(" ", microtime());

        $this->startTime = ((float) $usec + (float) $this->string_ec);
        $this->startMemory = memory_get_usage(true);
    }

    protected function stop($time_itle)
    {

        list($usec, $this->string_ec) = explode(" ", microtime());
        $time = ((float) $usec + (float) $this->string_ec) - $this->startTime;
        $memory = memory_get_usage(true);
//	$memory -= $this->startMemory;
        echo str_pad($time_itle, 23) . " : " . number_format($time, 5) . " sec et ";
        $this->totalTime += $time;
        unset($time, $usec, $this->string_ec);
        $delta = $memory- $this->startMemory;
	echo $memory . " - " . $this->startMemory.  " " .$delta . " ";
echo memory_get_peak_usage(), " ";
	echo $this->convert($delta);
        $this->totalMemory += $delta;
    }

    protected function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i] . "\n";
    }

    public function benchmarkFor()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; ++$i)
            ;

        $this->stop('for');
    }

    public function benchmarkWhile()
    {
        $this->start();

        while ($i > 0)
            --$i;

        $this->stop('while');
    }

    public function benchmarkIfElse()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            $z = $i % 4;

            if ($z == 0) {
                
            } else if ($z == 1) {
                
            } else if ($z == 2) {
                
            } else {
                
            }
        }

        $this->stop('if else');
    }

    public function benchmarkSwitch()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            $z = $i % 4;

            switch ($z) {

                case 0: break;

                case 1: break;

                case 2: break;

                default: break;
            }
        }

        $this->stop('switch');
    }

    public function benchmarkTernaire()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            $z = ($i % 2 == 0 ? 1 : 0);
        }

        $this->stop('Ternary');
    }

    public function benchmarkStrReplace()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            str_replace('&', '&amp;', $this->string_1);

        $this->stop('str_replace');
    }

    public function benchmarkPregReplace()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times_slow_function; $i++)
            preg_replace("#(^|\s)(http[s]?://\w+[^\s\[\]\<]+)#i", '\1<a href="\2">\2</a>', $this->string_6);

        $this->stop('preg_replace');
    }

    public function benchmarkPregMatch()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            preg_match("#http[s]?://\w+[^\s\[\]\<]+#", $this->string_6);

        $this->stop('preg_match');
    }

    public function benchmarkCount()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            count($this->array_1);

        $this->stop('count');
    }

    public function benchmarkIsset()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            isset($this->array_1['i']);

            isset($this->array_1['zzNozz']);
        }

        $this->stop('isset');
    }

    public function benchmarkTime()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            time();

        $this->stop('time');
    }

    public function benchmarkStrlen()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            strlen($this->string_1);

        $this->stop('strlen');
    }

    public function benchmarkSprintf()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            sprintf($this->string_7, $i, $this->string_5, $i);

        $this->stop('sprintf');
    }

    public function benchmarkStrcmp()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            strcmp($this->string_7, $this->string_8);

        $this->stop('strcmp');
    }

    public function benchmarkTrim()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            trim($this->string_2);

        $this->stop('trim');
    }

    public function benchmarkExplode()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times_slow_function; $i++)
            explode('&', $this->string_1);

        $this->stop('explode');
    }

    public function benchmarkImplode()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            implode('&', $this->array_1);

        $this->stop('implode');
    }

    public function benchmarkNumberFormat()
    {
        $f1 = $this->totalTime;

        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            number_format($f1, 3);

        $this->stop('number_format');
    }

    public function benchmarkFloor()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            floor($f1);

        $this->stop('floor');
    }

    public function benchmarkStrpos()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            strpos($this->string_2, 't');

        $this->stop('strpos');
    }

    public function benchmarkSubstr()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            substr($this->string_1, 10);

        $this->stop('substr');
    }

    public function benchmarkIntval()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            intval($this->string_4);

        $this->stop('intval');
    }

    public function benchmarkInt()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            (int) $this->string_4;

        $this->stop('(int)');
    }

    public function benchmarkIsArray()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            is_array($this->array_1);

            is_array($this->string_1);
        }

        $this->stop('is_array');
    }

    public function benchmarkIsNumeric()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            is_numeric($f1);

            is_numeric($this->string_4);
        }

        $this->stop('is_numeric');
    }

    public function benchmarkIsInt()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            is_int($f1);

            is_int($this->string_4);
        }

        $this->stop('is_int');
    }

    public function benchmarkIsString()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            is_string($f1);

            is_string($this->string_4);
        }

        $this->stop('is_string');
    }

    public function benchmarkIp2long()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            ip2long('1.2.3.4');

        $this->stop('ip2long');
    }

    public function benchmarklong2ip()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            long2ip(89851921);

        $this->stop('long2ip');
    }

    public function benchmarkDate()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times_slow_function; $i++)
            date('F j, Y, g:i a', $this->now);

        $this->stop('date');
    }

    public function benchmarkStrftime()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times_slow_function; $i++)
            strftime('%B %e, %Y, %l:%M %P', $this->now);

        $this->stop('strftime');
    }

    public function benchmarkStrtotime()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times_slow_function; $i++)
            strtotime($time_1);

        $this->stop('strtotime');
    }

    public function benchmarkStrtolower()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            strtolower($this->string_3);

        $this->stop('strtolower');
    }

    public function benchmarkStrtoupper()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            strtoupper($this->string_1);

        $this->stop('strtoupper');
    }

    public function benchmarkMd5()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            md5($this->string_1);

        $this->stop('md5');
    }

    public function benchmarkUnset()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++) {

            unset($this->array_1['j']);

            $this->array_1['j'] = 0;
        }

        $this->stop('unset');
    }

    public function benchmarkList()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            list($drink, $this->run_timesolor, $power) = $this->array_2;

        $this->stop('list');
    }

    public function benchmarkUrlencode()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            urlencode($this->string_1);

        $this->stop('urlencode');
    }

    public function benchmarkUrldecode()
    {
        $this->string_1e = urlencode($this->string_1);

        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            urldecode($this->string_1e);

        $this->stop('urldecode');
    }

    public function benchmarkAddslashes()
    {
        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            addslashes($this->string_9);

        $this->stop('addslashes');
    }

    public function benchmarkStripslashes()
    {
        $string_9e = addslashes($this->string_9);

        $this->start();

        for ($i = 0; $i < $this->run_times; $i++)
            stripslashes($string_9e);

        $this->stop('stripslashes');
    }

}
