<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class RedisTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:redis-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $redis = Redis::connection("default");

        // string
        $redis->set("string:php:string", "string value");

        $array = [
            "key1" => "value1",
            "key2" => "value2",
            "key3" => "value3",
        ];
        $redis->set("string:php:array", json_encode($array));

        // hash
        $redis->hset("hash:php", "key1", "value1");
        $redis->hset("hash:php", "key2", "value2");
        $redis->hset("hash:php", "key3", "value3");


        // stream
        for ($i = 0; $i < 10; $i++) {
            $data = [
                "key1" => "value1-{$i}",
                "key2" => "value2-{$i}",
                "key3" => "value3-{$i}",
            ];
            $redis->xadd("stream:php", "*", $data);
        }
    }
}
