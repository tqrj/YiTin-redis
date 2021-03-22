<?php

namespace YiTin;

use Co\System;

/**
 * Class ArtLock
 */
class TinLock
{
    /**
     * @var string
     */
    private string $lockKey;

    /**
     * @var bool
     */
    private bool $lockStatus = false;

    /**
     * @var int|string
     */
    private string $lockFlag;

    /**
     * @var int
     */
    private int $outTimeMs;

    private string $lockLua = "
        local key = KEYS[1] 
        local val = ARGV[1] 
        local px = ARGV[2]
        local temp = nil
        local res = redis.call('set',key,val,'nx','px',px)
        if(res == true)
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
        $this->lockFlag = uniqid(mt_rand(1,9999999999),true);

        if (!$this->lockFlag) {
            return false;
        }
        return $this->lockFlag;
    }


    /**
     * @return bool
     */
    public function lock(): bool
    {
        if ($this->lockStatus) {
            return true;
        }
        do {
            $this->lockStatus = (bool)TinRedis::eval($this->lockLua, ['TinLock' . $this->lockKey,$this->lockFlag, $this->outTimeMs],1);
            if (false == $this->lockStatus) {
                System::sleep(0.01);
            }
        } while (!$this->lockStatus);

        return $this->lockStatus;
    }

    /**
     * @return bool
     */
    public function tryLock(): bool
    {
        if ($this->lockStatus) {
            return true;
        }
        $this->lockStatus = (bool)TinRedis::eval($this->lockLua, ['TinLock' . $this->lockKey,$this->lockFlag, $this->outTimeMs], 1);
        return $this->lockStatus;
    }

    /**
     * @return bool
     */
    public function unLock(): bool
    {
        if (false == $this->lockStatus) {
            return false;
        }
        $status = (bool)TinRedis::eval($this->unLockLua,['TinLock' . $this->lockKey,$this->lockFlag],1);
        $this->lockStatus = !$status;
        return $status;
    }

    /**
     * @return string
     */
    public function getLockKey(): string
    {
        return $this->lockKey;
    }

    /**
     * @return int
     */
    public function getOutTimeMs(): int
    {
        return $this->outTimeMs;
    }

    /**
     * @return bool
     */
    public function getStatus(): bool
    {
        return $this->lockStatus;
    }
}