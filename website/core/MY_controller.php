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
    protected $userInfo;
    
    public function __construct() {
        parent::__construct();
        session_start();
        $this->initData();
        $this->isLogined();
    }
    
    //初始化数据
    private function initData() {
        self::$urlSuffix = config_item('url_suffix');
    }
    
    //是否登录
    private function isLogined() {
        if (isset($_SESSION['userInfo'])) {
            if (!isset($_SESSION['userInfo']['portrait'])) {
                $_SESSION['userInfo']['portrait'] = DEFAULT_HEADER;
            }
            $this->userInfo = $_SESSION['userInfo'];
        } else {
            $this->userInfo = FALSE;
        }
    }
    
    /**
     * 发送邮件
     *
     * @param      $to      接收人
     * @param      $subject 主题
     * @param      $message 内容
     * @param null $cc      抄送
     * @param null $bcc
     *
     * @return mixed
     */
    protected function sendEmail($to, $subject, $message, $cc = NULL, $bcc = NULL) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.163.com';
        $config['smtp_user'] = 'hexiaodong2810@163.com';
        $config['smtp_pass'] = 'xiaodong120825';
        $config['smtp_port'] = '25';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $this->load->library('email', $config);
        $from = 'hexiaodong2810@163.com';
        $fromName = 'phpdady';
        $this->email->from($from, $fromName);
        $this->email->to($to);
        $this->email->cc($cc);
        $this->email->bcc($bcc);
        
        $this->email->subject($subject);
        $this->email->message($message);
        
        return $this->email->send();
    }
    
    /**
     * 防刷
     *
     * @param int $timestamp 请求间隔时间（单位：秒）
     */
    protected function preventBrush($timestamp = 60) {
        if (isset($_SESSION['preventBrush']) && $_SESSION['preventBrush'] + $timestamp > time()) {
            PJsonMsg(REQUEST_ERROR, lang('request_invalid'));
        } else {
            $_SESSION['preventBrush'] = time();
        }
    }
}