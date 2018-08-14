<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
    <title>404页面 - 懒人图库</title>
    <script type="text/javascript">
        var t = 4;
        var a = setInterval(function () {
            $('.timestamp').html(t);
            t--;
            if (t == 0) {
                clearInterval(a);
                top.location = 'http://www.hexiaodong.com';
            }
        }, 1000);
    </script>
    <style type="text/css">
        body {
            text-align: center
        }

        h1 {
            font-family: "微软雅黑"
        }
    </style>
</head>

<body>
<p><img src="/assets/images/404.gif" width="520" height="320"/></p>
<h1>抱歉，这个页面已经被外星人绑架了</h1>
<p><span class="timestamp">5</span>秒钟后将带您返回地球</p>
<script src="/assets/js/jquery.min.js"></script>
</body>
</html>
