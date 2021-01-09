<?php


use Co\System;

/**
 * Class ArtLock
 */
class ArtLock
{
    private string $lockKey;

    private bool $lockStatus = false;

    private int $lockFlag;

    private int $outTimeMs;

    private string $lockLua = "
        local key = KEYS[1] 
        local val = ARGV[1] 
        local px = ARGV[2]
        local temp = nil
        res = redis.call('set',key,val,'nx','px',px)
        if(res == 'ok')
        then
            return 1
        else
            temp = redis.call('get',key)
            if(temp == val)
            then
                return 1
            else
                return 0
            end
        end";
    private string $unLockLua = "
        local key = KEYS[1]
        local val = ARGV[1]
        local temp = nil
        temp = redis.call('get',key)
        if(temp == val)
        then
            return redis.call('del',key)
        else
            return 0
        end";

    /**
     * ArtLock constructor.
     * @param string $lockKey
     * @param int $outTimeMs 这个超时是防止redis 死锁没有释放redis ex所设置的超时
     */
    public function __construct(string $lockKey, int $outTimeMs)
    {
        $this->lockKey = $lockKey;
        $this->outTimeMs = $outTimeMs;
        $this->lockFlag = ArtRedis::incr('artCount');
        if (!$this->lockFlag) {
            return false;
        }
        return $this->lockFlag;
    }


    /**
     * @return bool
     */
    public function lock()
    {
        if ($this->lockStatus) {
            return true;
        }
        do {
            $this->lockStatus = (bool)ArtRedis::eval($this->lockLua, ['ArtLock' . $this->lockKey], [$this->lockFlag, $this->outTimeMs]
            );
            if (false == $this->lockStatus) {
                System::sleep(0.01);
            }
        } while (!$this->lockStatus);

        return $this->lockStatus;
    }

    public function tryLock()
    {
        if ($this->lockStatus) {
            return true;
        }
        $this->lockStatus = (bool)ArtRedis::eval($this->lockLua, ['ArtLock' . $this->lockKey], [$this->lockFlag, $this->outTimeMs]);
        return $this->lockStatus;
    }

    /**
     * @return bool
     */
    public function unLock()
    {
        if (false == $this->lockStatus) {
            return false;
        }
        return (bool)ArtRedis::eval($this->unLockLua,['ArtLock' . $this->lockKey],[$this->lockFlag]);
    }
}