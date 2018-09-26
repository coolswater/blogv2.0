<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * 数据迁移类
 * author: hexiaodong
 * Date: 2018/9/19
 */
class Migrate extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        //备份数据库
        $this->load->dbutil();
        $backupFile = date('Y-m-d') . 'mysql_backup.sql';
        $prefs = array(
            'tables'     => array(),         // Array of tables to backup.
            'ignore'     => array(),         // List of tables to omit from the backup
            'format'     => 'txt',           // gzip, zip, txt
            'filename'   => $backupFile,     // File name - NEEDED ONLY WITH ZIP FILES
            'add_drop'   => TRUE,            // Whether to add DROP TABLE statements to backup file
            'add_insert' => TRUE,            // Whether to add INSERT data to backup file
            'newline'    => "\n"             // Newline character used in backup file
        );
        
        $backup = $this->dbutil->backup($prefs);
        if ($backup) {
            $this->load->library('migration');
            if (!$this->migration->current()) {
                show_error($this->migration->error_string());
            } else {
                echo '数据迁移成功！';
            }
            write_file('./backup/' . date('Y-m-d') . 'mysql_backup.sql', $backup);
        } else {
            write_file('logs/' . date('Y-m-d') . 'backup.log', '数据备份失败！');
            echo '数据迁移失败';
        }
    }
}