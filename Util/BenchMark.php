<?php
/**
 * Created by PhpStorm.
 * User: zxqc2018
 * Date: 2019/4/1
 * Time: 14:12
 */

namespace Share\Util;

class BenchMark
{
    /**
     * 获取换行符
     * @return string
     * @author zxqc2018
     */
    public static function getLineChar()
    {
        return php_sapi_name() === 'cli' ? "\n" : '<br/>';
    }

    /**
     * 计算重复执行方法的执行时间
     * @param callable $callback  回调方法
     * @param array $arg 参数数组
     * @param int $repeatTimes 重复次数
     * @return string
     * @author zxqc2018
     */
    public static function executeTime($callback, array $arg, $repeatTimes = 1000)
    {
        $startTime = microtime(true);

        //执行方法
        for ($i = 0; $i < $repeatTimes; $i++) {
            call_user_func_array($callback, $arg);
        }
        $endTime = microtime(true);

        $elapseTime = $endTime - $startTime;

        $res = "method is execute {$repeatTimes} times, elapse {$elapseTime} s";
        echo $res . self::getLineChar();
        return $elapseTime;
    }

    public static function test()
    {
        echo 123 . self::getLineChar();
    }
}