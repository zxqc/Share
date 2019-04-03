<?php
/**
 * Created by PhpStorm.
 * User: zxqc2018
 * Date: 2019/4/2
 * Time: 10:41
 */

namespace Share\Util;


class Collection
{
    public static function getSubset($arr)
    {
        $res = [];
        $n = count($arr);

        $maxSubset = (1 << $n) - 1;
        for ($i = 0; $i <= $maxSubset; $i++) {
            $binStr = sprintf("%0{$n}b", $i);
            $tmpArr = [];
            for ($j = 0; $j < $n; $j++) {
                if ($binStr[$j] == 1) {
                    $tmpArr[] = $arr[$j];
                }
            }
            $res[] = $tmpArr;

        }
        return $res;
    }

    static function set($part='',$s=0)
    {
        var_dump(func_get_args());
        $arr= array(1,2);
        echo '{'.trim($part,',').'}' . "\n";
        for($start=$s;$start<count($arr);$start++)
        {
            Collection::set($part.','.$arr[$start],$start+1);
        }
    }
}