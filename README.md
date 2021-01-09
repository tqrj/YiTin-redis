# YiTin-redis
Swoole Redis连接池 自动归还 基础的Redis分布式 互斥锁

## 说明
    使用 TinLock（互斥锁） 之前需要先 初始化 TinRedis
    如果你是在多进程的模式下使用 那么请在每个进程 Start 的时候 初始化TinRedis
    如若不然会导致 你的连接 每个进程都在使用，那么就会崩~
    swoole 的很多框架 都有实现 什么Redis代理的 你连进程隔离都不用管自动维护了但是好像都不支持完全协程化的写法 当然那种高度封装的肯定是比我这个玩具要好。
    如果你不是出于学习，蛋疼的情况下，没有理由使用本类！
    
## 安装
`composer require yi-tin/redis`

## 使用




    \YiTin\TinRedis::initialize((new RedisConfig())
       ->withHost('127.0.0.1')
        ->withPort(6379)
        ->withAuth('')
        ->withDbIndex(1)
        ->withTimeout(1),
        64
    );
    
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
## Todo
    读写锁
    延时队列
    
