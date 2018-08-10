<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class MY_controller
 * 基类
 *
 * @author Hexd
 * @date   2018/08/08
 */
class MY_controller extends CI_Controller {
    protected static $urlSuffix;        //url后缀
    
    public function __construct() {
        parent::__construct();
        session_start();
        $this->initData();
    }
    
    //初始化数据
    private function initData() {
        self::$urlSuffix = config_item('url_suffix');
    }
}