<?php

namespace yiTin;

/**
 * 封装 Redis类 方法
 * @method static bool isConnected()
 * @method static string|bool getHost()
 * @method static int|bool getPort()
 * @method static int|bool getDbNum()
 * @method static float|bool getTimeout()
 * @method static float|bool getReadTimeout()
 * @method static string|null|bool getPersistentID()
 * @method static string|null|bool getAuth()
 * @method static bool swapdb(int $db1, int $db2)
 * @method static mixed|null getOption($option)
 * @method static bool|string ping($message)
 * @method static string echo ($message)
 * @method static string|mixed|bool get($key)
 * @method static bool set($key, $value, $timeout = NULL)
 * @method static bool setex($key, $ttl, $value)
 * @method static bool psetex($key, $ttl, $value)
 * @method static bool setnx($key, $value)
 * @method static int del($key1, ...$otherKeys)
 * @method static int delete($key1, $key2 = NULL, $key3 = NULL)
 * @method static int unlink($key1, $key2 = NULL, $key3 = NULL)
 * @method static Redis multi($mode = 1)
 * @method static void|array exec()
 * @method static mixed discard()
 * @method static void watch($key)
 * @method static mixed unwatch()
 * @method static mixed|null subscribe($channels, $callback)
 * @method static mixed psubscribe($patterns, $callback)
 * @method static int publish($channel, $message)
 * @method static array|int pubsub($keyword, $argument)
 * @method static mixed unsubscribe($channels = NULL)
 * @method static mixed punsubscribe($patterns = NULL)
 * @method static int|bool exists($key)
 * @method static int incr($key)
 * @method static float incrByFloat($key, $increment)
 * @method static int incrBy($key, $value)
 * @method static int decr($key)
 * @method static int decrBy($key, $value)
 * @method static int|bool lPush($key, ...$value1)
 * @method static int|bool rPush($key, ...$value1)
 * @method static int|bool lPushx($key, $value)
 * @method static int|bool rPushx($key, $value)
 * @method static mixed|bool lPop($key)
 * @method static mixed|bool rPop($key)
 * @method static array blPop($keys, $timeout)
 * @method static array brPop(array $keys, $timeout)
 * @method static int|bool lLen($key)
 * @method static int lSize($key)
 * @method static mixed|bool lIndex($key, $index)
 * @method static mixed|bool lGet($key, $index)
 * @method static bool lSet($key, $index, $value)
 * @method static array lRange($key, $start, $end)
 * @method static array lGetRange($key, $start, $end)
 * @method static array|bool lTrim($key, $start, $stop)
 * @method static mixed listTrim($key, $start, $stop)
 * @method static int|bool lRem($key, $value, $count)
 * @method static mixed lRemove($key, $value, $count)
 * @method static int lInsert($key, $position, $pivot, $value)
 * @method static int|bool sAdd($key, ...$value1)
 * @method static int sRem($key, ...$member1)
 * @method static mixed sRemove($key, ...$member1)
 * @method static bool sMove($srcKey, $dstKey, $member)
 * @method static bool sIsMember($key, $value)
 * @method static mixed sContains($key, $value)
 * @method static int sCard($key)
 * @method static string|mixed|array|bool sPop($key, $count = 1)
 * @method static string|mixed|array|bool sRandMember($key, $count = 1)
 * @method static array sInter($key1, ...$otherKeys)
 * @method static int|bool sInterStore($dstKey, $key1, ...$otherKeys)
 * @method static array sUnion($key1, ...$otherKeys)
 * @method static int sUnionStore($dstKey, $key1, ...$otherKeys)
 * @method static array sDiff($key1, ...$otherKeys)
 * @method static int|bool sDiffStore($dstKey, $key1, ...$otherKeys)
 * @method static array sMembers($key)
 * @method static array sGetMembers($key)
 * @method static array|bool sScan($key, &$iterator, $pattern = NULL, $count = 0)
 * @method static string|mixed getSet($key, $value)
 * @method static string randomKey()
 * @method static bool select($dbIndex)
 * @method static bool move($key, $dbIndex)
 * @method static bool rename($srcKey, $dstKey)
 * @method static mixed renameKey($srcKey, $dstKey)
 * @method static bool renameNx($srcKey, $dstKey)
 * @method static bool expire($key, $ttl)
 * @method static bool pExpire($key, $ttl)
 * @method static bool setTimeout($key, $ttl)
 * @method static bool expireAt($key, $timestamp)
 * @method static bool pExpireAt($key, $timestamp)
 * @method static array keys($pattern)
 * @method static mixed getKeys($pattern)
 * @method static int dbSize()
 * @method static bool auth($password)
 * @method static bool bgrewriteaof()
 * @method static bool slaveof($host = '127.0.0.1', $port = 6379)
 * @method static mixed slowLog(string $operation, ?int $length = NULL)
 * @method static string|int|bool object($string = '', $key = '')
 * @method static bool save()
 * @method static bool bgsave()
 * @method static int lastSave()
 * @method static int wait($numSlaves, $timeout)
 * @method static int type($key)
 * @method static int append($key, $value)
 * @method static string getRange($key, $start, $end)
 * @method static mixed substr($key, $start, $end)
 * @method static int setRange($key, $offset, $value)
 * @method static int strlen($key)
 * @method static int bitpos($key, $bit, $start = 0, $end = NULL)
 * @method static int getBit($key, $offset)
 * @method static int setBit($key, $offset, $value)
 * @method static int bitCount($key)
 * @method static int bitOp($operation, $retKey, $key1, ...$otherKeys)
 * @method static bool flushDB()
 * @method static bool flushAll()
 * @method static array sort($key, $option = NULL)
 * @method static string info($option = NULL)
 * @method static bool resetStat()
 * @method static int|bool ttl($key)
 * @method static int|bool pttl($key)
 * @method static bool persist($key)
 * @method static bool mset(array $array)
 * @method static array getMultiple(array $keys)
 * @method static array mget(array $array)
 * @method static int msetnx(array $array)
 * @method static string|mixed|bool rpoplpush($srcKey, $dstKey)
 * @method static string|mixed|bool brpoplpush($srcKey, $dstKey, $timeout)
 * @method static int zAdd($key, $options, $score1, $value1, $score2 = NULL, $value2 = NULL, $scoreN = NULL, $valueN = NULL)
 * @method static array zRange($key, $start, $end, $withscores = NULL)
 * @method static int zRem($key, $member1, ...$otherMembers)
 * @method static int zDelete($key, $member1, ...$otherMembers)
 * @method static array zRevRange($key, $start, $end, $withscore = NULL)
 * @method static array zRangeByScore($key, $start, $end, array $options = array())
 * @method static array zRevRangeByScore($key, $start, $end, array $options = array())
 * @method static array|bool zRangeByLex($key, $min, $max, $offset = NULL, $limit = NULL)
 * @method static array zRevRangeByLex($key, $min, $max, $offset = NULL, $limit = NULL)
 * @method static int zCount($key, $start, $end)
 * @method static int zRemRangeByScore($key, $start, $end)
 * @method static mixed zDeleteRangeByScore($key, $start, $end)
 * @method static int zRemRangeByRank($key, $start, $end)
 * @method static mixed zDeleteRangeByRank($key, $start, $end)
 * @method static int zCard($key)
 * @method static int zSize($key)
 * @method static float|bool zScore($key, $member)
 * @method static int|bool zRank($key, $member)
 * @method static int|bool zRevRank($key, $member)
 * @method static float zIncrBy($key, $value, $member)
 * @method static int zUnionStore($output, $zSetKeys, ?array $weights = NULL, $aggregateFunction = 'SUM')
 * @method static mixed zUnion($Output, $ZSetKeys, ?array $Weights = NULL, $aggregateFunction = 'SUM')
 * @method static int zInterStore($output, $zSetKeys, ?array $weights = NULL, $aggregateFunction = 'SUM')
 * @method static mixed zInter($Output, $ZSetKeys, ?array $Weights = NULL, $aggregateFunction = 'SUM')
 * @method static array|bool zScan($key, &$iterator, $pattern = NULL, $count = 0)
 * @method static array bzPopMax($key1, $key2, $timeout)
 * @method static array bzPopMin($key1, $key2, $timeout)
 * @method static array zPopMax($key, $count = 1)
 * @method static array zPopMin($key, $count = 1)
 * @method static int|bool hSet($key, $hashKey, $value)
 * @method static bool hSetNx($key, $hashKey, $value)
 * @method static string hGet($key, $hashKey)
 * @method static int|bool hLen($key)
 * @method static int|bool hDel($key, $hashKey1, ...$otherHashKeys)
 * @method static array hKeys($key)
 * @method static array hVals($key)
 * @method static array hGetAll($key)
 * @method static bool hExists($key, $hashKey)
 * @method static int hIncrBy($key, $hashKey, $value)
 * @method static float hIncrByFloat($key, $field, $increment)
 * @method static bool hMSet($key, $hashKeys)
 * @method static array hMGet($key, $hashKeys)
 * @method static array hScan($key, &$iterator, $pattern = NULL, $count = 0)
 * @method static int hStrLen(string $key, string $field)
 * @method static int geoadd($key, $longitude, $latitude, $member)
 * @method static array geohash($key, ...$member)
 * @method static array geopos(string $key, string $member)
 * @method static float geodist($key, $member1, $member2, $unit = NULL)
 * @method static mixed georadius($key, $longitude, $latitude, $radius, $unit, ?array $options = NULL)
 * @method static array georadiusbymember($key, $member, $radius, $units, ?array $options = NULL)
 * @method static array config($operation, $key, $value)
 * @method static mixed eval($script, $args = array(), $numKeys = 0)
 * @method static mixed evaluate($script, $args = array(), $numKeys = 0)
 * @method static mixed evalSha($scriptSha, $args = array(), $numKeys = 0)
 * @method static mixed evaluateSha($scriptSha, $args = array(), $numKeys = 0)
 * @method static mixed script($command, $script)
 * @method static string|null getLastError()
 * @method static bool clearLastError()
 * @method static mixed client($command, $value = '')
 * @method static string _prefix($value)
 * @method static mixed _unserialize($value)
 * @method static mixed _serialize($value)
 * @method static string|bool dump($key)
 * @method static bool restore($key, $ttl, $value)
 * @method static bool migrate($host, $port, $key, $db, $timeout, $copy = false, $replace = false)
 * @method static array time()
 * @method static array|bool scan(&$iterator, $pattern = NULL, $count = 0)
 * @method static bool pfAdd($key, array $elements)
 * @method static int pfCount($key)
 * @method static bool pfMerge($destKey, array $sourceKeys)
 * @method static mixed rawCommand($command, $arguments)
 * @method static int getMode()
 * @method static int xAck($stream, $group, $messages)
 * @method static string xAdd($key, $id, $messages, $maxLen = 0, $isApproximate = false)
 * @method static array xClaim($key, $group, $consumer, $minIdleTime, $ids, $options = array())
 * @method static int xDel($key, $ids)
 * @method static mixed xGroup($operation, $key, $group, $msgId = '', $mkStream = false)
 * @method static mixed xInfo($operation, $stream, $group)
 * @method static int xLen($stream)
 * @method static array xPending($stream, $group, $start = NULL, $end = NULL, $count = NULL, $consumer = NULL)
 * @method static array xRange($stream, $start, $end, $count = NULL)
 * @method static array xRead($streams, $count = NULL, $block = NULL)
 * @method static array xReadGroup($group, $consumer, $streams, $count = NULL, $block = NULL)
 * @method static array xRevRange($stream, $end, $start, $count = NULL)
 * @method static int xTrim($stream, $maxLen, $isApproximate)
 * @method static int|bool sAddArray($key, array $values)
 */
class ArtRedis
{

    private static self $instance;
    private static \Swoole\Database\RedisPool $pool;

    private function __construct(\Swoole\Database\RedisConfig $redisConfig,$size)
    {
        if (empty(self::$pool)) {
            self::$pool = new \Swoole\Database\RedisPool($redisConfig,$size);

        }
    }

    private function __clone()
    {

    }

    private function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    public static function initialize(\Swoole\Database\RedisConfig $redisConfig,$size)
    {
        if (empty(self::$instance)) {
            self::$instance = new static($redisConfig,$size);
        }
        return self::$instance;
    }

    private static function put(Redis $redis)
    {
        self::$pool->put($redis);
    }

    private static function pop()
    {
        return self::$pool->get();
    }

    public static function __callStatic ($name, $arguments)
    {
        $redis = self::pop();
        if (!$redis instanceof Redis) {
            return false;
        }
        //$result = call_user_func_array([$redis, $name], $arguments);
        $result = $redis->$name(...$arguments);
        self::put($redis);
        return $result;
    }
}