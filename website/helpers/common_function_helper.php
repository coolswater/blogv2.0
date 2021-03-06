<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
date_default_timezone_set('PRC');
/**
 * 常用方法封装
 *
 * @author  hxd
 * @time    2016-04-07
 */

/**
 * 获取任一长度随机字符串
 *
 * @param   int $length 字符串长度
 *
 * @return  string  $str    返回字符串
 */
function get_salt($length) {
    $str = 'abcdefghijklmnopqistuvwxyz0123456789!@#$%^&*';
    $str = str_shuffle($str);
    $rand = rand(0, strlen($str) - $length);
    $str = substr($str, $rand, $length);
    
    return $str;
}

/**
 * IP查找
 *
 * @param   string $num ip地址
 *
 * @return  string      返回区域或城市
 */
if (!function_exists('ip_city_ext')) {
    function ip_city_ext($num) {
        $info = ipnum_info($num);
        if (empty($info)) {
            return "未知区域";
        }
        
        return strtoupper($info['area'] . ',' . $info['city']);
    }
}

/**
 * 记录日志文件
 *
 * @param   string $logFile 日志文件
 * @param   string $data    写入数据
 */
if (!function_exists("write_log")) {
    function write_log($logFile, $data) {
        $dir = pathinfo($logFile)['dirname'];
        if (!is_dir($logFile)) {
            @mkdir($dir, 0755, TRUE);
        }
        error_log("[" . date("Y-m-d H:i:s") . "]$data\r\n", 3, $logFile);
    }
}

/**
 * 验证邮箱
 *
 * @param   string $email 电子邮件地址
 *
 * @return
 */
if (!function_exists("validEmail")) {
    function validEmail($email) {
        if (strlen($email) > 50 || strlen($email) < 4) {
            return FALSE;
        }
        
        return preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $email);
    }
}

/**
 * IsMobile函数:检测参数的值是否为正确的中国手机号码格式
 * 返回值:是正确的手机号码返回手机号码,不是返回false
 *
 * @param   string $phone 手机号码
 *
 * @return  mixed  false/mobile
 */
if (!function_exists("validPhone")) {
    function validPhone($phone) {
        if (strlen($phone) != 11) {
            return FALSE;
        }
        
        return preg_match("/^(13[0-9]{1}|15[0-9]{1}|18[0-9]{1}|14[0-9]{1}|17[0-9]{1})[0-9]{8}$/", $phone);
    }
}

/**
 * is_num函数:检测参数是否是纯数字
 *
 * @param   string $string 被检测字符串
 *
 * @return  boolean TRUE/FALSE
 */
if (!function_exists("validNum")) {
    function is_num($string) {
        return preg_match('/^[0-9]*$/', $string) ? TRUE : FALSE;
    }
}

/**
 * validStrIsStrAndNum验证字符串是否由n-n+x个字母和数字组成(不区分大小写)
 *
 * @param    string $string 被检测字符串
 *
 * @return    bool    TRUE/FALSE
 */
if (!function_exists('validStrIsStrAndNum')) {
    function validStrIsStrAndNum($string, $min, $max) {
        return preg_match('/^[a-z\d]{' . $min . ',' . $max . '}$/i', $string) ? TRUE : FALSE;
    }
}

/**
 * is_qq函数:检测参数的值是否符合QQ号码的格式
 * 返回值:是正确的QQ号码返回QQ号码,不是返回false
 *
 * @param   string $qq 被检测字符串
 *
 * @return  mixed   $qq/false   返回qq号码或者false
 */
if (!function_exists("is_qq")) {
    function is_qq($qq) {
        $RegExp = '/^[1-9][0-9]{5,16}$/';
        
        return preg_match($RegExp, $qq) ? $qq : FALSE;
    }
}
/**
 * 验证是否为url
 *
 * @param string  $str         url地址
 * @param boolean $exp_results 是否返回结果
 */
if (!function_exists("is_url")) {
    function is_url($str, $exp_results = FALSE) {
        $RegExp = '/^((ht|f)tps?):\/\/[\w\-]+(\.[\w\-]+)+([\w\-\.,@?^=%&:\/~\+#]*[\w\-\@?^=%&\/~\+#])?$/';
        if (!preg_match($RegExp, $str, $m)) {
            return FALSE;
        }
        if ($exp_results == TRUE) {
            return $m;
        }
        
        return TRUE;
    }
}

/**
 * 检测是否含有敏感词
 *
 * @param   string $word 被检测字符串
 *
 * @return  boolean TRUE/FALSE  是否存在
 */
if (!function_exists("isFilterWords")) {
    function isFilterWords($word, $filterwords) {
        foreach ($filterwords as $k => $v) {
            $filterwords[$k] = trim($v);
        }
        $str = implode('|', $filterwords);
        if (preg_match("/$str/", $word, $match) == 1) {//\n是匹配过滤字符后面的回车字符的
            return TRUE;
        } else {
            return FALSE;
        }
    }
}

/**
 * 替换敏感词汇
 *
 * @param   string $word 被替换字符串
 *
 * @return  string  $content    返回替换后的字符串
 */
if (!function_exists("filterWords")) {
    function filterWords($word, $filterwords) {
        foreach ($filterwords as $k => $v) {
            $filterwords[$k] = trim($v);
        }
        $str = @implode('|', $filterwords);
        $content = preg_replace("/$str/i", '***', $word);
        
        return $content;
    }
}

/**
 * 获取客户端的IP地址
 *
 * @return  string  $ip 返回ip地址
 */
if (!function_exists("get_client_ip")) {
    function get_client_ip() {
        $ks = array(
            "HTTP_X_FORWARDED_FOR",
            "HTTP_CLIENT_IP",
            "REMOTE_ADDR",
        );
        $kc = count($ks);
        for ($i = 0; $i < $kc; $i++) {
            $k = $ks[$i];
            $ip = trim(isset($_SERVER[$k]) ? $_SERVER[$k] : getenv($k));
            if (empty($ip) || strcasecmp($ip, "unknown") == 0) {
                continue;
            }
            $ips = explode(",", $ip);
            $ip = trim($ips[0]);
            
            if (is_ip($ip)) {
                return $ip;
            }
        }
        
        return '0.0.0.0';
    }
}

/**
 * 判断是否ip地址
 *
 * @param   string $gonten 被检测字符串
 *
 * @return  boolean TRUE/FALSE  是否
 */
if (!function_exists("is_ip")) {
    function is_ip($gonten) {
        $ip = explode(".", $gonten);
        for ($i = 0; $i < count($ip); $i++) {
            if ($ip[$i] > 255) {
                return (0);
            }
        }
        
        return preg_match("/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/", $gonten);
    }
}

/**
 * 安全过滤数据
 *
 * @param   string  $str        需要处理的字符
 * @param   string  $type       返回的字符类型，支持，string,int,float,html
 * @param   maxid   $default    当出现错误或无数据时默认返回值
 * @param   boolean $checkempty 强制转化为正数
 *
 * @return  mixed               当出现错误或无数据时默认返回值
 */
if (!function_exists("getParam")) {
    function getParam($str, $type = 'string', $default = NULL, $checkempty = FALSE, $pnumber = FALSE) {
        switch ($type) {
            case 'string': //字符处理
                $_str = strip_tags($str);
                $_str = str_replace("'", '&#39;', $_str);
                $_str = str_replace("\"", '&quot;', $_str);
                $_str = str_replace("\\", '', $_str);
                $_str = str_replace("\/", '', $_str);

//                $_str = daddslashes(html_escape($_str));
                
                break;
            case 'int': //获取整形数据
                $_str = verify_id($str);
                break;
            case 'float': //获浮点形数据
                $_str = (float)$str;
                break;
            case 'html': //获取HTML，防止XSS攻击
                $_str = reMoveXss($str);
                break;
            case 'time':
                $_str = $str ? strtotime($str) : '';
                break;
            default: //默认当做字符处理
                $_str = strip_tags($str);
                break;
        }
        if ($checkempty == TRUE) {
            if (empty($str)) {
                header("content-type:text/html;charset=utf-8;");
                exit("非法操作！");
            }
        }
        
        if (($type == 'string' && empty($str)) || (empty($str) && $str != 0) || !isset($str)) {
            return $default;
        }
        if ($type == "int" || $type == "float") {
            $_str = $pnumber == TRUE ? abs($_str) : $_str;
            
            return $_str;
        }
        
        return trim($_str);
    }
}

//过滤XSS攻击
if (!function_exists("reMoveXss")) {
    function reMoveXss($val) {
        $val = preg_replace('/([\x00-\x08|\x0b-\x0c|\x0e-\x19])/', '', $val);
        $search = 'abcdefghijklmnopqrstuvwxyz';
        $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $search .= '1234567890!@#$%^&*()';
        $search .= '~`";:?+/={}[]-_|\'\\';
        for ($i = 0; $i < strlen($search); $i++) {
            $val = preg_replace('/(&#[xX]0{0,8}' . dechex(ord($search[$i])) . ';?)/i', $search[$i], $val); // with a ;
            $val = preg_replace('/(&#0{0,8}' . ord($search[$i]) . ';?)/', $search[$i], $val); // with a ;
        }
        $ra1 = Array(
            'javascript',
            'vbscript',
            'expression',
            'applet',
            'meta',
            'xml',
            'blink',
            'link',
            '<script',
            'object',
            'iframe',
            'frame',
            'frameset',
            'ilayer'
            /* , 'layer' */,
            'bgsound',
            'base',
        );
        $ra2 = Array(
            'onabort',
            'onactivate',
            'onafterprint',
            'onafterupdate',
            'onbeforeactivate',
            'onbeforecopy',
            'onbeforecut',
            'onbeforedeactivate',
            'onbeforeeditfocus',
            'onbeforepaste',
            'onbeforeprint',
            'onbeforeunload',
            'onbeforeupdate',
            'onblur',
            'onbounce',
            'oncellchange',
            'onchange',
            'onclick',
            'oncontextmenu',
            'oncontrolselect',
            'oncopy',
            'oncut',
            'ondataavailable',
            'ondatasetchanged',
            'ondatasetcomplete',
            'ondblclick',
            'ondeactivate',
            'ondrag',
            'ondragend',
            'ondragenter',
            'ondragleave',
            'ondragover',
            'ondragstart',
            'ondrop',
            'onerror',
            'onerrorupdate',
            'onfilterchange',
            'onfinish',
            'onfocus',
            'onfocusin',
            'onfocusout',
            'onhelp',
            'onkeydown',
            'onkeypress',
            'onkeyup',
            'onlayoutcomplete',
            'onload',
            'onlosecapture',
            'onmousedown',
            'onmouseenter',
            'onmouseleave',
            'onmousemove',
            'onmouseout',
            'onmouseover',
            'onmouseup',
            'onmousewheel',
            'onmove',
            'onmoveend',
            'onmovestart',
            'onpaste',
            'onpropertychange',
            'onreadystatechange',
            'onreset',
            'onresize',
            'onresizeend',
            'onresizestart',
            'onrowenter',
            'onrowexit',
            'onrowsdelete',
            'onrowsinserted',
            'onscroll',
            'onselect',
            'onselectionchange',
            'onselectstart',
            'onstart',
            'onstop',
            'onsubmit',
            'onunload',
        );
        $ra = array_merge($ra1, $ra2);
        
        $found = TRUE; // keep replacing as long as the previous round replaced something
        while ($found == TRUE) {
            $val_before = $val;
            for ($i = 0; $i < sizeof($ra); $i++) {
                $pattern = '/';
                for ($j = 0; $j < strlen($ra[$i]); $j++) {
                    if ($j > 0) {
                        $pattern .= '(';
                        $pattern .= '(&#[xX]0{0,8}([9ab]);)';
                        $pattern .= '|';
                        $pattern .= '|(&#0{0,8}([9|10|13]);)';
                        $pattern .= ')*';
                    }
                    $pattern .= $ra[$i][$j];
                }
                $pattern .= '/i';
                $replacement = substr($ra[$i], 0, 2) . '<x>' . substr($ra[$i], 2); // add in <> to nerf the tag
                $val = preg_replace($pattern, $replacement, $val); // filter out the hex tags
                if ($val_before == $val) {
                    $found = FALSE;
                }
            }
        }
        
        return $val;
    }
}

/**
 * 校验提交的ID类值是否合法verify_id()
 *
 * @param   string $id 提交的ID值
 *
 * @return  string  返回处理后的ID
 */
if (!function_exists("verify_id")) {
    function verify_id($id = NULL) {
        if (!isset($id)) {
            return 0;
        } // 是否为空判断
        elseif (filter_inject($id)) {
            return 0;
        } // 注射判断
        elseif (!is_numeric($id)) {
            return $id;
        } // 数字判断
        $id = intval($id); // 整型化
        
        return $id;
    }
}

/**
 * 处理form 提交的参数过滤
 *
 * @param   string /array    $string 需要处理的字符串或者数组
 *                 $force   boolen          $force  是否强制进行处理
 *
 * @return  string/array            返回处理之后的字符串或者数组
 */
if (!function_exists("daddslashes")) {
    function daddslashes($string, $force = TRUE) {
        if (is_array($string)) {
            $keys = array_keys($string);
            foreach ($keys as $key) {
                $val = $string[$key];
                unset($string[$key]);
                $string[addslashes($key)] = daddslashes($val, $force);
            }
        } else {
            $string = addslashes($string);
        }
        
        return $string;
    }
}

/**
 * 处理form 提交的参数过滤
 *
 * @param   string $string 需要处理的字符串
 *
 * @return  string  $str    返回处理之后的字符串或者数组
 */
if (!function_exists("filter_form")) {
    function filter_form($str) {
        $str = str_replace("and", "", $str);
        $str = str_replace("execute", "", $str);
        $str = str_replace("update", "", $str);
        $str = str_replace("count", "", $str);
        $str = str_replace("chr", "", $str);
        $str = str_replace("mid", "", $str);
        $str = str_replace("master", "", $str);
        $str = str_replace("truncate", "", $str);
        $str = str_replace("char", "", $str);
        $str = str_replace("declare", "", $str);
        $str = str_replace("select", "", $str);
        $str = str_replace("create", "", $str);
        $str = str_replace("delete", "", $str);
        $str = str_replace("insert", "", $str);
        $str = str_replace("or", "", $str);
        $str = str_replace("=", "", $str);
        $str = str_replace("%20", "", $str);
        
        return $str;
    }
}

/**
 * 检测提交的值是不是含有SQL注射的字符，防止注射，保护服务器安全
 *
 * @param   string $sql_str 提交的变量
 *
 * @return  boolean             返回检测结果，ture or false
 */
if (!function_exists("filter_inject")) {
    function filter_inject($sql_str) {
        return @preg_match('select|insert|and|or|update|delete|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile', $sql_str); // 进行过滤
    }
}

/**
 * 处理禁用HTML但允许换行的内容
 *
 * @param   string $msg 需要过滤的内容
 *
 * @return  string          返回过滤后的字符串
 */
if (!function_exists('TrimMsg')) {
    function TrimMsg($msg) {
        $msg = trim(stripslashes($msg));
        $msg = nl2br(htmlspecialchars($msg));
        $msg = str_replace("  ", "&nbsp;&nbsp;", $msg);
        
        return addslashes($msg);
    }
}

/**
 * PHP判断字符串纯汉字 OR 纯英文 OR 汉英混合
 *
 * @param   string $str 被检测字符串
 *
 * @return  int     1:英文 2：纯汉字 3：汉字和英文
 */

function str_type($str) {
    $mb = mb_strlen($str, 'utf-8');
    $st = strlen($str);
    if ($st == $mb) {
        return 1;
    }
    if ($st % $mb == 0 && $st % 3 == 0) {
        return 2;
    }
    
    return 3;
}

/**
 * 字符串截取，支持中文和其他编码
 *
 * @param   string $str     需要转换的字符串
 * @param   string $start   开始位置
 * @param   string $length  截取长度
 * @param   string $charset 编码格式
 * @param   string $suffix  截断显示字符
 *
 * @return  string
 */
function msubstr($str, $start = 0, $length, $suffix = TRUE, $charset = "utf-8") {
    $strength = mb_strlen($str);
    if (function_exists("mb_substr")) {
        if ($suffix) {
            if ($length < $strength) {
                return mb_substr($str, $start, $length, $charset) . "...";
            } else {
                return mb_substr($str, $start, $length, $charset);
            }
        } else {
            return mb_substr($str, $start, $length, $charset);
        }
    } elseif (function_exists('iconv_substr')) {
        if ($suffix) {//是否加上......符号
            if ($length < $strength) {
                return iconv_substr($str, $start, $length, $charset) . "...";
            } else {
                return iconv_substr($str, $start, $length, $charset);
            }
        } else {
            return iconv_substr($str, $start, $length, $charset);
        }
    }
    
    $re['utf-8'] = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
    $re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
    $re['gbk'] = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
    $re['big5'] = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
    preg_match_all($re[$charset], $str, $match);
    $slice = join("", array_slice($match[0], $start, $length));
    if ($suffix) {
        return $slice . "...";
    } else {
        return $slice;
    }
}

/**
 * 返回字符串长度
 *
 * @param   string $str     需要计算的字符串
 * @param   string $charset 字符编码
 *
 * @return  length  int
 */

function abslength($str, $charset = 'utf-8') {
    if (empty($str)) {
        return 0;
    }
    if (function_exists('mb_strlen')) {
        return mb_strlen($str, 'utf-8');
    } else {
        @preg_match_all("/./u", $str, $ar);
        
        return count($ar[0]);
    }
}

/**
 * 加密解密方法
 *
 * @param   string $string    明文或密文
 * @param   string $operation 加密ENCODE或解密DECODE
 * @param   string $key       密钥
 * @param   int    $expiry    密钥有效期 ， 默认是一直有效
 */
if (!function_exists("auth_code")) {
    function auth_code($string, $operation = 'DECODE', $key = '', $expiry = 0) {
        /*
            动态密匙长度，相同的明文会生成不同密文就是依靠动态密匙
            加入随机密钥，可以令密文无任何规律，即便是原文和密钥完全相同，加密结果也会每次不同，增大破解难度。
            取值越大，密文变动规律越大，密文变化 = 16 的 $ckey_length 次方
            当此值为 0 时，则不产生随机密钥
            */
        
        $ckey_length = 4;
        $key = md5($key != '' ? $key : "sgxgjihoegs"); // 此处的key可以自己进行定义，写到配置文件也可以
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length) : substr(md5(microtime()), -$ckey_length)) : '';
        
        $cryptkey = $keya . md5($keya . $keyc);
        $key_length = strlen($cryptkey);
        // 明文，前10位用来保存时间戳，解密时验证数据有效性，10到26位用来保存$keyb(密匙b)，解密时会通过这个密匙验证数据完整性
        // 如果是解码的话，会从第$ckey_length位开始，因为密文前$ckey_length位保存 动态密匙，以保证解密正确
        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0) . substr(md5($string . $keyb), 0, 16) . $string;
        $string_length = strlen($string);
        
        $result = '';
        $box = range(0, 255);
        
        $rndkey = array();
        for ($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }
        
        for ($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }
        
        for ($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }
        
        if ($operation == 'DECODE') {
            if ((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26) . $keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            // 把动态密匙保存在密文里，这也是为什么同样的明文，生产不同密文后能解密的原因
            // 因为加密后的密文可能是一些特殊字符，复制过程可能会丢失，所以用base64编码
            return $keyc . str_replace('=', '', base64_encode($result));
        }
    }
}


/**
 * 计算密码强度
 *
 * @param   string $password 被检测字符串
 *
 * @return  int     $level      安全等级
 */
if (!function_exists("getPassLevel")) {
    function getPassLevel($password) {
        $partArr = array(
            '/[0-9]/',
            '/[a-z]/',
            '/[A-Z]/',
            '/[\W_]/',
        );
        $score = 0;
        
        //根据长度加分
        $score += strlen($password);
        //根据类型加分
        foreach ($partArr as $part) {
            if (preg_match($part, $password)) {
                $score += 5;
            }//某类型存在加分
            $regexCount = preg_match_all($part, $password, $out);//某类型存在，并且存在个数大于2加2份，个数大于5加7份
            if ($regexCount >= 5) {
                $score += 7;
            } elseif ($regexCount >= 2) {
                $score += 2;
            }
        }
        //重复检测
        $repeatChar = '';
        $repeatCount = 0;
        for ($i = 0; $i < strlen($password); $i++) {
            if ($password{$i} == $repeatChar) {
                $repeatCount++;
            } else {
                $repeatChar = $password{$i};
            }
        }
        $score -= $repeatCount * 2;
        //等级输出
        $level = 0;
        if ($score <= 10) { //弱
            $level = 1;
        } elseif ($score <= 25) { //一般
            $level = 2;
        } elseif ($score <= 37) { //很好
            $level = 3;
        } elseif ($score <= 50) { //极佳
            $level = 4;
        } else {
            $level = 4;
        }
        //如果是密码为123456
        if (in_array($password, array(
            '123456',
            'abcdef',
        ))) {
            $level = 1;
        }
        
        return $level;
    }
}

/**
 * 获取订单号
 *
 * @return  string  返回订单号
 */
if (!function_exists('get_order_sn')) {
    function get_order_sn() {
        /* 选择一个随机的方案 */
        mt_srand((double)microtime() * 1000000);
        
        return date('YmdHis') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }
}

/**
 * JSON输出
 *
 * @param   array $data 数组
 *
 * @return  string          json字符串
 */
if (!function_exists("printJson")) {
    function printJson($data) {
        $jcb = getParam(isset($_REQUEST['jsoncallback']) ? $_REQUEST['jsoncallback'] : '');
        if ($jcb) {//如果是跨域操作
            echo $jcb . "(" . json_encode($data, JSON_UNESCAPED_UNICODE) . ");";
        } else {
            //var_dump(is_object(json_encode($data)));
            exit(json_encode($data, JSON_UNESCAPED_UNICODE));    //中文不转码
        }
        exit();
    }
}

/**
 * 发送http请求
 *
 * @return string
 */
function sendHttp($url, $data = array(), $post = TRUE, $httpHeader = array(), $cookieFile = '/tmp/mycookiefile') {
    if (is_array($data)) {
        $data = http_build_query($data);
    }
    if (!$post) {
        $url .= '?' . $data;
    }
    $options = array(
        CURLOPT_URL            => $url,
        CURLOPT_HEADER         => FALSE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_USERAGENT      => 'CURL ' . date('Y-m-d H:i:s'),
        CURLOPT_FOLLOWLOCATION => TRUE,
        CURLOPT_TIMEOUT        => 10,
    );
    if ($post) {
        $options[CURLOPT_POST] = TRUE;
        $options[CURLOPT_POSTFIELDS] = $data;
    }
    if ($cookieFile) {
        $options[CURLOPT_COOKIEFILE] = $cookieFile;
        $options[CURLOPT_COOKIEJAR] = $cookieFile;
    }
    if ($httpHeader) {
        $options[CURLOPT_HTTPHEADER] = $httpHeader;
    }
    $ch = curl_init();
    curl_setopt_array($ch, $options);
    $info = curl_exec($ch);
    curl_close($ch);
    
    return $info;
}

/**
 * 获取随机数
 *
 * @param        $length 随记数长度
 * @param string $chars  随机字符串
 *
 * @return string 返回生成的随机数
 */
function random($length, $chars = '0123456789') {
    $hash = '';
    $max = strlen($chars) - 1;
    for ($i = 0; $i < $length; $i++) {
        $hash .= $chars[mt_rand(0, $max)];
    }
    
    return $hash;
}


//排序二维数组，指定字段排列
function sortArray($source, $filed, $sort = 'desc') {
    
    $arr = array();
    foreach ($source as $key => $value) {
        $arr[$key] = $value[$filed];
    }
    
    array_multisort($arr, $sort == 'desc' ? SORT_DESC : SORT_ASC, $source);
    
    return $source;
}

/**
 * 字符串查找，是否包含
 *
 * @param   string $str  被检测字符串
 * @param   string $find 查找字符串
 *
 * @return  bool    TRUE/FALS   是否
 */

function isContain($str, $find) {
    if (empty($find)) {
        return TRUE;
    }
    
    $pos = strpos($str, $find);
    if ($pos === FALSE) {
        return FALSE;
    } else {
        return TRUE;
    }
}

/**
 * 数组中是否包含某个字符串
 *
 * @param   array  $source 数组
 * @param   string $search 被检测字符串
 * @param   string $d      分隔符默认是','
 *
 * @return  bool    TRUE/FALSE  是/否
 */
function in_array_exist($source, $search, $d = ',') {
    
    if (empty($search) || empty($source)) {
        return FALSE;
    }
    
    $source = explode($d, $source);
    if (in_array($search, $source)) {
        return TRUE;
    }
    
    return FALSE;
}

/**
 * 返回当前页面的URL
 */
function cur_page_url() {
    
    $pageURL = 'http';
    if (isset($_SERVER["HTTPS"]) ? $_SERVER["HTTPS"] : '' == "on") {
        $pageURL .= "s";
    }
    $pageURL .= "://";
    
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
    }
    
    return $pageURL;
}

/**
 * cookie设置
 *
 * @param $var    设置的cookie名
 * @param $value  设置的cookie值
 * @param $life   设置的过期时间：为整型，单位秒 如60表示60秒后过期
 * @param $path   设置的cookie作用路径
 * @param $domain 设置的cookie作用域名
 */
function sets_cookie($array, $life = 0, $path = '/', $domain = COOKIE_DOMAIN) {
    $_cookName_ary = array_keys($array);
    for ($i = 0; $i < count($array); $i++) {
        setcookie($_cookName_ary[$i], $array[$_cookName_ary[$i]], $life ? (time() + $life) : 0, $path, $domain);
    }
}

/**
 * 缓存文件
 *
 * @param   int $id  缓存id
 * @param   int $key 缓存文件名
 *
 * @return  string      缓存路径
 */
if (!function_exists('get_cache_key')) {
    function get_cache_key($id, $key) {
        $dir = dir_rule($id);
        $path = $dir;
        $date = date('Ymd', time());
        $dir = APPPATH . 'cache/' . $date . '/' . $path;
        if (!file_exists($dir)) {
            @mkdir($dir, 0755, TRUE);
        }
        
        return $date . '/' . $path . $key;
    }
}

/**
 * 科学计算法多值的计算
 * 加bcadd($a, $b, 4)（留4位小数）
 * 减bcsub($a, $b, 4)
 * 乘bcmul($a, $b, 4)
 * 除bcdiv($a, $b, 4)
 * 取余bcmod($a, $b)
 *
 * @param array  $num_arr 数字数组
 * @param string $method  +-*\/%
 * @param number $scale   保留几位小数
 */
function calculate($num1, $num2, $method = '+', $scale = 4) {
    
    $func = '';
    switch ($method) {
        case '+':
            $func = 'bcadd';
            break;
        case '-':
            $func = 'bcsub';
            break;
        case '*':
            $func = 'bcmul';
            break;
        case '/':
            $func = 'bcdiv';
            break;
        case '%':
            $func = 'bcmod';
            break;
        default:
            return FALSE;
    }
    
    $reNum = $func($num1, $num2, $scale);
    
    return $reNum;
}

/**
 * 文件写入操作
 *
 * @param   string $path 文件路径
 * @param   string $data 写入数据
 * @param   string $mode 写入模式
 *
 * @return  boolean           是否成功
 */
function write_txt($path, $data, $mode = FOPEN_WRITE_CREATE_DESTRUCTIVE) {
    if (!$fp = @fopen($path, $mode)) {
        return FALSE;
    }
    
    flock($fp, LOCK_EX);
    fwrite($fp, $data . "\r\n");
    flock($fp, LOCK_UN);
    fclose($fp);
    
    return TRUE;
}

/**
 * 记录上报日志
 *
 * @param   string $data 上报数据
 * @param   string $type 日志类型
 */
function write_report_log($data, $type) {
    
    $path = APPPATH . "logs/" . $type . '/' . date('Ymd', time()) . '/';
    if (!is_dir($path)) {
        @mkdir($path, 0755, TRUE);
    }
    
    $filename = $path . date('Ymd-H') . '.log';
    write_txt($filename, $data, "a+");
}

/**
 * json返回结果
 *
 * @param   string $code 状态码
 * @param   string $msg  返回信息
 * @param   array  $data 返回数据
 */
function PJsonMsg($code, $msg, $data = array()) {
    $result = array(
        'code' => $code,
        'msg'  => $msg,
        'data' => $data,
    );
    printJson($result);
}

//新版 api3.3及以上的签名算法
class Checksum {
    private static $BYTE_TABLE = array(
        "20",
        "bb",
        "40",
        "d4",
        "4e",
        "00",
        "ec",
        "3d",
        "2f",
        "a5",
        "d4",
        "2f",
        "7d",
        "1e",
        "11",
        "d7",
        "b2",
        "74",
        "20",
        "e9",
        "e3",
        "8b",
        "c0",
        "47",
        "e1",
        "c9",
        "91",
        "bf",
        "84",
        "03",
        "00",
        "85",
        "3d",
        "a5",
        "51",
        "c2",
        "c8",
        "dc",
        "e3",
        "17",
        "cb",
        "3e",
        "e2",
        "98",
        "55",
        "6a",
        "ad",
        "99",
        "23",
        "61",
        "ad",
        "c8",
        "f7",
        "08",
        "2f",
        "5f",
        "d6",
        "a7",
        "a9",
        "cd",
        "38",
        "e3",
        "2e",
        "e5",
        "82",
        "9f",
        "22",
        "42",
        "7e",
        "4b",
        "2b",
        "9d",
        "e2",
        "72",
        "c6",
        "3b",
        "50",
        "14",
        "d1",
        "af",
        "9f",
        "65",
        "21",
        "70",
        "0c",
        "f0",
        "e4",
        "73",
        "51",
        "69",
        "4a",
        "de",
        "c1",
        "54",
        "26",
        "2a",
        "b6",
        "5c",
        "71",
        "21",
        "1f",
        "1f",
        "18",
        "c8",
        "49",
        "f8",
        "32",
        "d3",
        "36",
        "6f",
        "83",
        "6e",
        "7b",
        "d7",
        "32",
        "1d",
        "d9",
        "8a",
        "d9",
        "07",
        "46",
        "a8",
        "f0",
        "27",
        "da",
        "97",
        "8b",
        "78",
        "58",
        "64",
        "f0",
        "ac",
        "64",
        "ea",
        "fa",
        "02",
        "5f",
        "c9",
        "e5",
        "38",
        "e7",
        "6f",
        "20",
        "4c",
        "a5",
        "1a",
        "be",
        "4f",
        "21",
        "56",
        "f5",
        "f2",
        "68",
        "8b",
        "d0",
        "48",
        "5c",
        "de",
        "38",
        "de",
        "8e",
        "3a",
        "1f",
        "99",
        "92",
        "62",
        "07",
        "cb",
        "47",
        "32",
        "d1",
        "11",
        "e3",
        "5e",
        "67",
        "d0",
        "7a",
        "df",
        "7a",
        "44",
        "80",
        "43",
        "c3",
        "6a",
        "95",
        "e4",
        "48",
        "3f",
        "2a",
        "a4",
        "f0",
        "ce",
        "ea",
        "a5",
        "e2",
        "d4",
        "60",
        "77",
        "97",
        "3b",
        "3e",
        "0f",
        "d3",
        "96",
        "c8",
        "eb",
        "5f",
        "1d",
        "48",
        "11",
        "9c",
        "77",
        "21",
        "cc",
        "cb",
        "bb",
        "53",
        "e0",
        "d3",
        "1d",
        "a9",
        "11",
        "5c",
        "34",
        "cb",
        "6e",
        "ee",
        "f9",
        "93",
        "b7",
        "76",
        "d1",
        "9c",
        "33",
        "e7",
        "2f",
        "4e",
        "32",
        "ae",
        "76",
        "f7",
        "1e",
        "23",
        "4f",
        "92",
        "17",
        "03",
        "66",
        "5e",
        "fa",
        "12",
        "2a",
        "11",
        "a7",
        "01",
        "04",
    );
    
    private static function getKey($num) {
        $sb = "";
        for ($i = 0; $i < 4; $i++) {
            $tmp = 1 << $i;
            $v = self::$BYTE_TABLE[$tmp];
            $sb .= $v;
        }
        $n = $num;
        while ($n > 0) {
            $idx = $n & 0xff;
            $n = $num >> 16;
            $v = self::$BYTE_TABLE[$idx];
            $sb .= $v;
        }
        
        return $sb;
    }
    
    private static function byte2hex($string) {
        $buf = "";
        for ($i = 0; $i < strlen($string); $i++) {
            $val = dechex(ord($string{$i}));
            if (strlen($val) < 2) {
                $val = "0" . $val;
            }
            $buf .= $val;
        }
        
        return $buf;
    }
    
    private static function hex2byte($string) {
        $buf = "";
        for ($i = 0; $i < strlen($string); $i += 2) {
            $item = substr($string, $i, 2);
            $item = hexdec($item);
            $val = chr($item);
            $buf .= $val;
        }
        
        return $buf;
    }
    
    public static function encode($data, $key) {
        
        $key = self::getKey($key);
        $mac_key = hash_hmac('sha256', $data, $key);
        $rs = "";
        $bytes = self::hex2byte($mac_key);
        if (!empty($bytes)) {
            for ($i = 0; $i < strlen($bytes) / 2; $i++) {
                $rs .= $bytes{$i * 2};
            }
        }
        $rs = self::byte2hex($rs);
        
        return $rs;
    }
}

//获取积分的对称加密算法
class DES {
    static function encrypt($key, $encrypt) {
        // 根据 PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) 修正 Message 加入 Padding
        $block = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_ECB);
        $pad = $block - (strlen($encrypt) % $block);
        $encrypt .= str_repeat(chr($pad), $pad);
        
        // 不需要设定 IV 进行加密
        $passcrypt = mcrypt_encrypt(MCRYPT_DES, $key, $encrypt, MCRYPT_MODE_ECB);
        
        return base64_encode($passcrypt);
    }
    
    static function decrypt($key, $decrypt) {
        // 不需要设定 IV
        $str = mcrypt_decrypt(MCRYPT_DES, $key, base64_decode($decrypt), MCRYPT_MODE_ECB);
        
        // 根据 PKCS#7 RFC 5652 Cryptographic Message Syntax (CMS) 修正 Message 移除 Padding
        $pad = ord($str[strlen($str) - 1]);
        
        return substr($str, 0, strlen($str) - $pad);
    }
}

/**
 * app key 算法
 */
class APPKEY {
    
    static $INDEXS = array(
        5,
        0,
        7,
        2,
        6,
        1,
        4,
        3,
    );
    static $MASKS = array(
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
    );
    
    static function int2bytes($v1, $v2) {
        
        $buf = array();
        for ($i = 0; $i < 4; $i++) {
            $buf[3 - $i] = ($v1 >> ($i * 8)) & 0xff;
        }
        for ($i = 0; $i < 4; $i++) {
            $buf[7 - $i] = ($v2 >> ($i * 8)) & 0xff;
        }
        
        return $buf;
    }
    
    static function bytes_encode($buf) {
        
        if (count($buf) != 8) {
            return NULL;
        }
        
        $result = array();
        for ($i = 0; $i < 8; $i++) {
            $f = self::$INDEXS[$i];
            $result[$i] = ($buf[$f]) ^ (self::$MASKS[$i]);
        }
        
        return $result;
    }
    
    //编码
    static function encode($uid, $appid) {
        $buf = self::int2bytes($uid, $appid);
        $bytes = self::bytes_encode($buf);
        
        return sprintf("%02X%02X%02X%02X%02X%02X%02X%02X", $bytes[0], $bytes[1], $bytes[2], $bytes[3], $bytes[4], $bytes[5], $bytes[6], $bytes[7]);
    }
}

/**
 * Drkey 算法
 * $uid, $appid,$cid,$adid,$udid
 * '4816', '4485','6105','2806','24B0D5A7-20E9-4815-86D5-A033F33449C2'
 * 00008512110000D00000F6170A0000D924B0D5A7-20E9-4815-86D5-A033F33449C2
 */
class DrKey {
    
    static $INDEXS = array(
        5,
        0,
        7,
        2,
        6,
        1,
        4,
        3,
    );
    static $MASKS = array(
        0,
        0,
        0,
        0,
        0,
        0,
        0,
        0,
    );
    
    static function int2bytes($v1, $v2) {
        
        $buf = array();
        for ($i = 0; $i < 4; $i++) {
            $buf[3 - $i] = ($v1 >> ($i * 8)) & 0xff;
        }
        for ($i = 0; $i < 4; $i++) {
            $buf[7 - $i] = ($v2 >> ($i * 8)) & 0xff;
        }
        
        return $buf;
    }
    
    static function bytes_encode($buf) {
        
        if (count($buf) != 8) {
            return NULL;
        }
        
        $result = array();
        for ($i = 0; $i < 8; $i++) {
            $f = self::$INDEXS[$i];
            $result[$i] = ($buf[$f]) ^ (self::$MASKS[$i]);
        }
        
        return $result;
    }
    
    function bytes_decode($buf) {
        
        if (count($buf) != 8) {
            return NULL;
        }
        
        $result = array();
        for ($i = 0; $i < 8; $i++) {
            $f = self::$INDEXS[$i];
            $result[$f] = ($buf[$i]) ^ (self::$MASKS[$i]);
        }
        
        return $result;
    }
    
    static function appkey_encode($uid, $appid) {
        
        $buf = self::int2bytes($uid, $appid);
        $bytes = self::encode($buf);
        
        return sprintf("%02X%02X%02X%02X%02X%02X%02X%02X", $bytes[0], $bytes[1], $bytes[2], $bytes[3], $bytes[4], $bytes[5], $bytes[6], $bytes[7]);
    }
    
    static function appkey_decode($key) {
        
        $len = strlen($key);
        $bytes = array();
        $k = 0;
        for ($i = 0; $i < $len; $i += 2) {
            $code = substr($key, $i, 2);
            $bytes[$k++] = hexdec($code);
        }
        
        $bytes = self::bytes_decode($bytes);
        
        $v2 = ($bytes[4] << 24) | ($bytes[5] << 16) | ($bytes[6] << 8) | $bytes[7];
        $v1 = ($bytes[0] << 24) | ($bytes[1] << 16) | ($bytes[2] << 8) | $bytes[3];
        
        return array(
            'v1' => $v1,
            "v2" => $v2,
        );
    }
    
    //编码
    static function encode($uid, $appid, $cid, $adid, $udid) {
        $buf = self::int2bytes($uid, $appid);
        $buf_ads = self::int2bytes($cid, $adid);
        $bytes = self::bytes_encode($buf);
        $bytes_ads = self::bytes_encode($buf_ads);
        $result = sprintf("%02X%02X%02X%02X%02X%02X%02X%02X", $bytes[0], $bytes[1], $bytes[2], $bytes[3], $bytes[4], $bytes[5], $bytes[6], $bytes[7]);
        $result .= sprintf("%02X%02X%02X%02X%02X%02X%02X%02X", $bytes_ads[0], $bytes_ads[1], $bytes_ads[2], $bytes_ads[3], $bytes_ads[4], $bytes_ads[5], $bytes_ads[6], $bytes_ads[7]);
        
        return $result . $udid;
    }
    
    static function decode($drkey) {
        
        $len = strlen($drkey);
        $appkey = substr($drkey, 0, 16);
        $adskey = substr($drkey, 16, 16);
        
        $mac = '02:00:00:00:00:00';
        $idfa = '';
        if ($len - 32 > 17) {
            if (strpos($drkey, ':')) {
                $mac = substr($drkey, 32, 17);
                if ($len - 49 > 0) {
                    $idfa = substr($drkey, 49, $len - 49);
                }
            } else {
                $idfa = substr($drkey, 32, $len - 32);
            }
        } else {
            $mac = substr($drkey, 32, 17);
        }
        $appkey = self::appkey_decode($appkey);
        $adskey = self::appkey_decode($adskey);
        
        return array(
            "mac"   => $mac,
            "idfa"  => $idfa,
            "uid"   => $appkey['v1'],
            "appid" => $appkey['v2'],
            "cid"   => $adskey['v1'],
            "adid"  => $adskey['v2'],
        );
    }
}

/**
 * 使用openssl库进行加密
 *
 * @param  string $string 要加密字符串
 * @param  string $key    加密key
 *
 * @return string   $string 加密后的字符串
 */
function opensslEncrypt($string, $key, $method = 'AES-256-ECB') {
    $str = openssl_encrypt($string, $method, $key);
    
    return $str;
}

/**
 * 使用openssl库进行解密
 *
 * @param  string $string 要解密字符串
 * @param  string $key    解密key
 *
 * @return string   $string 解密后的字符串
 */
function opensslDecrypt($string, $key, $method = 'AES-256-ECB') {
    $str = openssl_decrypt($string, $method, $key);
    
    return $str;
}

//任意字符编码转换为UTF-8
function get_utf8($string) {
    $encode = mb_detect_encoding($string);
    $string = iconv($encode, "UTF-8", $string);
    
    return $string;
}

/**
 * 判断文件规格
 *
 * @param   array  $uploadfile 上传文件
 * @param   string $filetype   文件类型
 * @param   string $width      文件宽度
 * @param   string $height     文件高度
 * @param   string $maxSize    最大容量
 *
 * @return  mixed
 */
function check_upload_file($uploadfile, $filetype = 'images', $maxSize = IMAGEMAXSIZE) {
    //检测是否是图片
    $result = getimagesize($uploadfile);
    if ($result === FALSE) {
        return 'typeError';
    } else {
        if ($result['bits'] > $maxSize) {
            return 'sizeError';
        }
    }
    
    return TRUE;
}

/**
 * 遍历替换
 *
 * @param   array  $arr     要遍历的数组
 * @param   string $replace 要替换的元素
 *
 * @return  string  $replace    返回替换过的元素
 */
function foreach_arr($arr, $replace) {
    foreach ($arr as $k => $v) {
        if ($k === $replace) {
            $replace = $v;
            break;
        }
    }
    
    return $replace;
}

//生成验证码
function verifyCode($width = 100, $height = 35) {
    //随机生成的字符串
    $str = strtoupper(rand_str(4));
    $_SESSION['verifyCode'] = md5($str);
    $fontface = "./assets/fonts/t1.ttf";
    
    //声明需要创建的图层的图片格式
    @ header("Content-Type:image/png");
    //创建一个图层
    $im = imagecreatetruecolor($width, $height);
    //背景色
    $back = imagecolorallocate($im, 255, 255, 255);
    //模糊点颜色
    $pix = imagecolorallocate($im, 250, 250, 250);
    imagefill($im, 0, 0, $pix);
    //绘模糊作用的点
    for ($i = 0; $i < 1000; $i++) {
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $pix);
    }
    //添加干扰线
    for ($i = 0; $i < 15; $i++) {
        $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagearc($im, mt_rand(-10, $width), mt_rand(-10, $height), mt_rand(30, 300), mt_rand(20, 200), 55, 44, $fontcolor);
    }
    for ($i = 0; $i < 255; $i++) {
        $fontcolor = imagecolorallocate($im, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imagesetpixel($im, mt_rand(0, $width), mt_rand(0, $height), $fontcolor);
    }
    //随机字符位置
    for ($i = 0; $i <= 3; $i++) {
        $fontcolor = imagecolorallocate($im, mt_rand(0, 120), mt_rand(0, 120), mt_rand(0, 120));
        imagettftext($im, ($height - 2) / 2, rand(-$height, $height), (($width - 5) / 5) * $i + (($width - 10) / 8), rand($height * 3 / 5, ($height * 3 / 5 + 5)), $fontcolor, $fontface, $str[$i]);
    }
    
    //输出图片
    imagepng($im);
    imagedestroy($im);
}

//获取随即字符
function rand_str($len) {
    
    $srcstr = "123456789abcdefghjkmnpqrstuvwxy";
    $strs = "";
    for ($i = 0; $i < $len; $i++) {
        $strs .= $srcstr[mt_rand(0, 30)];
    }
    
    return $strs;
}

//导出excel
function get_excel($title, $data) {
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:filename=xls_region.xls");
    
    echo "<table border='1'><tr>";
    //导出表头
    foreach ($title as $value) {
        echo "<th>" . $value . "</th>";
    }
    echo "</tr>";
    
    //导出数据
    foreach ($data as $v) {
        echo "<tr>";
        foreach ($title as $k => $vv) {
            echo "<td>" . $v[$k] . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

//数组转xml格式
class array_to_xml {
    private $version = '1.0';
    private $encoding = 'UTF-8';
    private $root = 'root';
    private $xml = NULL;
    
    function __construct() {
        $this->xml = new XMLWriter();
    }
    
    function toXml($data, $isArray = FALSE) {
        if (!$isArray) {
            $this->xml->openMemory();
            $this->xml->startDocument($this->version, $this->encoding);
            $this->xml->startElement($this->root);
        }
        
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $this->xml->startElement($key);
                $this->toXml($value, TRUE);
                $this->xml->endElement();
                        continue;
            }
            $this->xml->writeElement($key, $value);
        }
        if (!$isArray) {
            $this->xml->endElement();
            
            return $this->xml->outputMemory(TRUE);
        }
    }
    
    function toArray($string) {
        $arr = new SimpleXMLElement($string);
        
        return $arr;
    }
}

//匹配0.01到999.99数字
function match_num($num) {
    $pattern = '/^(?!0$)([1-9][0-9]{0,2}|0)(\.(?![0]{1,2}$)[0-9]{1,2})?$/';
    
    return preg_match($pattern, $num);
}

//获取请求来源域名
function request_source() {
    $url = $_SERVER["HTTP_REFERER"];   //获取完整的来路URL
    $str = str_replace("http://", "", $url);  //去掉http://
    $strdomain = explode("/", $str);           // 以“/”分开成数组
    $domain = $strdomain[0];        //取第一个“/”以前的字符
    
    return $domain;
}

/**
 * 预约防刷
 *
 * @param   string $key      key
 * @param   int    $interval 间隔秒数
 *
 * @return  string
 */
function prevent_brush($key, $interval) {
    $brush_key = $key . ip2long(get_client_ip());
    $now = time();
    if (isset($_SESSION[$brush_key]) && ($now - $_SESSION[$brush_key] < 0)) {
        PJsonMsg(REQUEST_ERROR, lang('server_busy'));
    } else {
        $_SESSION[$brush_key] = $now + $interval;
    }
}

//获取浏览器支持语言
function get_language() {
    $lang = empty($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? 'zh-C' : substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 4);
    if (preg_match("/zh-c/i", $lang)) {
        $lang = 1;
    } else if (preg_match("/zh/i", $lang)) {
        $lang = 2;
    } else if (preg_match("/en/i", $lang)) {
        $lang = 3;
    } else if (preg_match("/jp/i", $lang)) {
        $lang = 4;
    }
    
    return $lang;
}

//打印错误
function print_error($error_code, $error_msg = SERVER_ERROR) {
    PJsonMsg($error_code, lang($error_msg));
}

/**
 * 删除数组中为空的元素
 *
 * @param   $array  被检测数组
 *
 * @return  mixed
 */
function filter_arr($array) {
    foreach ($array as $k => $v) {
        if (empty($v)) {
            unset($array[$k]);
        }
    }
    
    return $array;
}

/**
 * 验证表单数据
 *
 * @param array  $array  被检测数组
 * @param string $except 非空数组/字符串
 *
 * @return mixed
 */
function check_data($array, $except) {
    //判断必填参数是否为空
    foreach ($array as $key => $value) {
        if (is_array($except)) {
            if (in_array($key, $except)) {
                continue;
            }
        } else {
            if ($key === $except) {
                continue;
            }
        }
        if (empty($value)) {
            PJsonMsg(REQUEST_FAIL, lang('param_illegal'), $key);
        }
    }
    
    return $array;
}

/**
 *  不加千分位逗号的数字格式化
 *
 * @param        $number        要格式化的数字
 * @param int    $decimals      小数位数
 * @param string $dec_point     小数点
 * @param string $thousands_sep 千分位符号
 *
 * @return string
 */
function _number_format($number, $decimals = 0, $dec_point = '.', $thousands_sep = '') {
    return number_format($number, $decimals, $dec_point, $thousands_sep);
    
}

/**
 * 获取本周的开始时间与结束时间
 *
 * @param $first   int  默认 1 表示每周星期一为开始日期 0表示每周日为开始日期
 *
 * @return $arr    array   开始结束时间
 */
function get_week_range($first = 1) {
    $sdefaultDate = date("Y-m-d");
    //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
    $w = date('w', strtotime($sdefaultDate));
    //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
    $week['start'] = date('Y-m-d', strtotime("$sdefaultDate -" . ($w ? $w - $first : 6) . ' days'));
    //本周结束日期
    $week['end'] = date('Y-m-d', strtotime($week['start'] . " +6 days"));
    
    return $week;
}

/**
 * 获取任意长度用户名
 *
 * @param   int $length 字符串长度
 *
 * @return  string  $str    返回字符串
 */
function get_username($length) {
    $str = 'abcdefghijklmnopqistuvwxyz0123456789';
    $str = str_shuffle($str);
    $rand = rand(0, strlen($str) - $length);
    $str = substr($str, $rand, $length);
    
    return $str;
}

//二维数组排序
if (!function_exists('array_sort_by')) {
    function array_sort_by($list, $field, $sortby = 'asc') {
        if (is_array($list)) {
            $refer = $resultSet = array();
            foreach ($list as $i => $data) {
                $refer[$i] = &$data[$field];
            }
            switch ($sortby) {
                case 'asc': // 正向排序
                    asort($refer);
                    break;
                case 'desc': // 逆向排序
                    arsort($refer);
                    break;
                case 'nat': // 自然排序
                    natcasesort($refer);
                    break;
            }
            foreach ($refer as $key => $val) {
                $resultSet[] = &$list[$key];
            }
            
            return $resultSet;
        }
        
        return FALSE;
    }
    
    /**
     * 访问客户端类型
     *
     * @return bool
     */
    function get_client() {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE'])) {
            return TRUE;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA'])) {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? TRUE : FALSE;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT'])) {
            $clientkeywords = array('nokia', 'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile',
            );
            
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
                return TRUE;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT'])) {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== FALSE) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === FALSE || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    //获取文章内容里的图片url
    function getImgUrl($content) {
        $pattern = '<img.*?src="(.*?)">';
        preg_match($pattern, $content, $match);
        
        return $match;
    }
    
    //验证身份证号
    function isIdcard($id) {
        $id = strtoupper($id);
        $regx = "/(^\d{15}$)|(^\d{17}([0-9]|X)$)/";
        $arr_split = array();
        if (!preg_match($regx, $id)) {
            return FALSE;
        }
        //检查15位
        if (15 == strlen($id)) {
            $regx = "/^(\d{6})+(\d{2})+(\d{2})+(\d{2})+(\d{3})$/";
            
            @preg_match($regx, $id, $arr_split);
            //检查生日日期是否正确
            $dtm_birth = "19" . $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth)) {
                return FALSE;
            } else {
                return TRUE;
            }
        } else {//检查18位
            $regx = "/^(\d{6})+(\d{4})+(\d{2})+(\d{2})+(\d{3})([0-9]|X)$/";
            @preg_match($regx, $id, $arr_split);
            $dtm_birth = $arr_split[2] . '/' . $arr_split[3] . '/' . $arr_split[4];
            if (!strtotime($dtm_birth))  //检查生日日期是否正确
            {
                return FALSE;
            } else {
                //检验18位身份证的校验码是否正确。
                //校验位按照ISO 7064:1983.MOD 11-2的规定生成，X可以认为是数字10。
                $arr_int = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
                $arr_ch = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
                $sign = 0;
                for ($i = 0; $i < 17; $i++) {
                    $b = (int)$id{$i};
                    $w = $arr_int[$i];
                    $sign += $b * $w;
                }
                $n = $sign % 11;
                $val_num = $arr_ch[$n];
                if ($val_num != substr($id, 17, 1)) {
                    return FALSE;
                } else {
                    return TRUE;
                }
            }
        }
        
    }
    
    //验证中文名字
    function isChineseName($name) {
        if (preg_match('/^([\xe4-\xe9][\x80-\xbf]{2}){2,5}$/', $name)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    //全角转半角
    function make_semiangle($str) {
        $arr = array('０' => '0', '１' => '1', '２' => '2', '３' => '3', '４' => '4',
                     '５' => '5', '６' => '6', '７' => '7', '８' => '8', '９' => '9',
                     'Ａ' => 'A', 'Ｂ' => 'B', 'Ｃ' => 'C', 'Ｄ' => 'D', 'Ｅ' => 'E',
                     'Ｆ' => 'F', 'Ｇ' => 'G', 'Ｈ' => 'H', 'Ｉ' => 'I', 'Ｊ' => 'J',
                     'Ｋ' => 'K', 'Ｌ' => 'L', 'Ｍ' => 'M', 'Ｎ' => 'N', 'Ｏ' => 'O',
                     'Ｐ' => 'P', 'Ｑ' => 'Q', 'Ｒ' => 'R', 'Ｓ' => 'S', 'Ｔ' => 'T',
                     'Ｕ' => 'U', 'Ｖ' => 'V', 'Ｗ' => 'W', 'Ｘ' => 'X', 'Ｙ' => 'Y',
                     'Ｚ' => 'Z', 'ａ' => 'a', 'ｂ' => 'b', 'ｃ' => 'c', 'ｄ' => 'd',
                     'ｅ' => 'e', 'ｆ' => 'f', 'ｇ' => 'g', 'ｈ' => 'h', 'ｉ' => 'i',
                     'ｊ' => 'j', 'ｋ' => 'k', 'ｌ' => 'l', 'ｍ' => 'm', 'ｎ' => 'n',
                     'ｏ' => 'o', 'ｐ' => 'p', 'ｑ' => 'q', 'ｒ' => 'r', 'ｓ' => 's',
                     'ｔ' => 't', 'ｕ' => 'u', 'ｖ' => 'v', 'ｗ' => 'w', 'ｘ' => 'x',
                     'ｙ' => 'y', 'ｚ' => 'z',
                     '（' => '(', '）' => ')', '〔' => '[', '〕' => ']', '【' => '[',
                     '】' => ']', '〖' => '[', '〗' => ']', '“' => '[', '”' => ']',
                     '‘' => '[', '’' => ']', '｛' => '{', '｝' => '}', '《' => '<',
                     '》' => '>',
                     '％' => '%', '＋' => '+', '—' => '-', '－' => '-', '～' => '-',
                     '：' => ':', '。' => '.', '、' => ',', '，' => '.', '、' => '.',
                     '；' => ',', '？' => '?', '！' => '!', '…' => '-', '‖' => '|',
                     '”' => '"', '’' => '`', '‘' => '`', '｜' => '|', '〃' => '"',
                     '　' => ' ', '＄' => '$', '＠' => '@', '＃' => '#', '＾' => '^', '＆' => '&', '＊' => '*',
                     '．' => '.', '／' => '/',
                     '＂' => '"');
        
        return strtr($str, $arr);
    }
}

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