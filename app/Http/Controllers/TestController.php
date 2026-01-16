<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    //I/O测试1
    public function testConcurrency1(): string
    {
        sleep(10);
        return '1';
    }
    
    //I/O测试2
    public function testConcurrency2(): string
    {
        return '2';
    }
    
    //redis测试
    public function testRedis(): string
    {
        Redis::set('name', 'lzx');

        return Redis::get('name');
    }
}
