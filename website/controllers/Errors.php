<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 错误处理
 * author: hexiaodong
 * Date: 2018/8/14
 */
class Errors extends MY_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    //404错误
    public function error404() {
        $this->load->view('home/404page');
    }
}