<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * 常用函数库
 * author: hexiaodong
 * Date: 2018/8/9
 */

/**
 * 日期转换成几分钟前
 *
 * @param int    $time       时间戳
 * @param strint $dateFormat 时间格式
 *
 * @return  string
 */
function formatTime($time, $dateFormat = 'Y.m.d H:i:s') {
    $rtime = date("H:i", $time);
    $date = date($dateFormat, $time);
    $timestamp = time() - $time;
    if ($timestamp < 60) {
        $str = '刚刚';
    } elseif ($timestamp < 60 * 60) {
        $min = floor($timestamp / 60);
        $str = $min . '分钟前';
    } elseif ($timestamp < 60 * 60 * 24) {
        $h = floor($timestamp / (60 * 60));
        $str = $h . '小时前 ';
    } elseif ($timestamp < 60 * 60 * 24 * 3) {
        $d = floor($timestamp / (60 * 60 * 24));
        if ($d == 1) {
            $str = '昨天 ' . $rtime;
        } else {
            $str = '前天 ' . $rtime;
        }
    } else {
        $str = $date;
    }
    
    return $str;
}