<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class MonologExample
{
    public static function run()
    {
        $log = new Logger('sample_logger');
        $log->pushHandler(new StreamHandler(__DIR__ . '/sample.log', Logger::DEBUG));
        $log->info('Hello Monolog!');
    }
}
