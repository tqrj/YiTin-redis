<?php

require 'vendor/autoload.php';
use Swoole\Database\RedisConfig;

\YiTin\TinRedis::initialize((new RedisConfig())
    ->withHost('127.0.0.1')
    ->withPort(6379)
    ->withAuth('')
    ->withDbIndex(1)
    ->withTimeout(1),
    64
);
\Co\run(function (){
    go(function (){
        $ArtLock = new \YiTin\TinLock('goods_100',5000);
        $status = $ArtLock->lock();
        if (!$status){
            echo '请求一:进入失败'.PHP_EOL;
            return;
        }
        echo '请求一:进入成功'.PHP_EOL;
        \Co\System::sleep(7);
        $status = $ArtLock->unLock();
        if(!$status){
            echo '请求一:退出失败'.PHP_EOL;
            return;
        }
        echo '请求一:退出成功'.PHP_EOL;
    });
    go(function (){
        $ArtLock = new \YiTin\TinLock('goods_100',5000);
        $status = $ArtLock->lock();
        if (!$status){
            echo '请求二:进入失败'.PHP_EOL;
            return;
        }
        echo '请求二:进入成功'.PHP_EOL;
        \Co\System::sleep(3);
        $status = $ArtLock->unLock();
        if(!$status){
            echo '请求二:退出失败'.PHP_EOL;
            return;
        }
        echo '请求二:退出成功'.PHP_EOL;
    });
});


