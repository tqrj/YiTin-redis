# yiTin-redis
Swoole redis连接池 自动归还 基础的redis分布式锁

## 安装
`composer require yi-tin/redis`

##使用

    ArtRedis::initialize((new RedisConfig())
    ->withHost('127.0.0.1')
    ->withPort(6379)
    ->withAuth(0)
    ->withDbIndex(1)
    ->withTimeout(1),
    64);
    
    \Co\run(function (){
    
        go(function (){
            $ArtLock = new ArtLock('goods_100',20000);
            $ArtLock->lock();
            echo '我进来了';
            \Co\System::sleep(10);
            $ArtLock->unLock();
            echo '我出来了';
        });
    
        go(function (){
            $ArtLock = new ArtLock('goods_100',20000);
            echo '我也进来了';
            $ArtLock->lock();
            echo '我也进来了';
            $ArtLock->unLock();
            echo '我也跟着出来了';
        });
    });
