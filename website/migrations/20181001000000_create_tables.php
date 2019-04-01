<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_tables extends CI_Migration {
    
    public function up() {
        //=======创建用户表================================
        $this->dbforge->add_field(array(
            'id'              => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => '用户id',
                'auto_increment' => TRUE,
            ),
            'username'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => FALSE,
                'unique'     => TRUE,
                'comment'    => '用户名',
            ),
            'password'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 38,
                'null'       => FALSE,
                'comment'    => '密码',
            ),
            'group_id'        => array(
                'type'       => 'TINYINT',
                'constraint' => 2,
                'comment'    => '用户组id',
                'default'    => 0,
            ),
            'nick_name'       => array(
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'null'       => FALSE,
                'unique'     => TRUE,
                'comment'    => '昵称',
            ),
            'portrait'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => FALSE,
                'comment'    => '头像',
            ),
            'mobile'          => array(
                'type'       => 'VARCHAR',
                'constraint' => 11,
                'unique'     => TRUE,
                'null'       => FALSE,
                'comment'    => '手机号码',
            ),
            'email'           => array(
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'unique'     => TRUE,
                'null'       => FALSE,
                'comment'    => '电子邮箱',
            ),
            'last_login_time' => array(
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => FALSE,
                'comment'    => '最后登录时间',
                'default'    => '0',
            ),
            'last_login_ip'   => array(
                'type'       => 'VARCHAR',
                'constraint' => 15,
                'null'       => FALSE,
                'comment'    => '最后登录ip',
            ),
            'status'          => array(
                'type'       => 'TINYINT',
                'constraint' => 15,
                'null'       => FALSE,
                'default'    => 0,
                'comment'    => '是否禁用   0-可用 1-禁用',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'用户表'",
        );
        $this->dbforge->create_table('t_users', TRUE, $attributes);
        
        //=======创建文章标签关联表================================
        $this->dbforge->add_field(array(
            'id'        => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => 'id',
                'auto_increment' => TRUE,
            ),
            'artcle_id' => array(
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'comment'    => '文章id',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('artcle_id');
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'文章标签关联表'",
        );
        $this->dbforge->create_table('t_tags_map', TRUE, $attributes);
        
        //=======创建友情链接表================================
        $this->dbforge->add_field(array(
            'id'          => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => 'id',
                'auto_increment' => TRUE,
            ),
            'name'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => FALSE,
                'comment'    => '链接名称',
            ),
            'logo'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => FALSE,
                'comment'    => '链接logo',
            ),
            'url'         => array(
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'comment'    => '链接地址',
                'default'    => 0,
            ),
            'create_time' => array(
                'type'    => 'DATETIME',
                'null'    => FALSE,
                'comment' => '创建时间',
            ),
            'status'      => array(
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => FALSE,
                'default'    => '0',
                'comment'    => '状态：0-正常 1-禁用',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'友情链接表'",
        );
        $this->dbforge->create_table('t_friend_links', TRUE, $attributes);
        
        //==============创建文章表======================================
        $this->dbforge->add_field(array(
            'id'           => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => '文章ID',
                'auto_increment' => TRUE,
            ),
            'title'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 30,
                'unique'     => TRUE,
                'null'       => FALSE,
                'comment'    => '文章标题',
            ),
            'summary'      => array(
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'null'       => FALSE,
                'comment'    => '摘要',
            ),
            'content'      => array(
                'type'    => 'text',
                'comment' => '文章内容',
                'null'    => FALSE,
            ),
            'cid'          => array(
                'type'       => 'INT',
                'constraint' => 4,
                'null'       => FALSE,
                'comment'    => '文章类别',
            ),
            'user_id'      => array(
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE,
                'comment'    => '用户id',
            ),
            'status'       => array(
                'type'       => 'TINYINT',
                'constraint' => 2,
                'null'       => FALSE,
                'default'    => 1,
                'comment'    => '状态：1-已发布 2-已保存 3-已删除',
            ),
            'thumb'        => array(
                'type'       => 'VARCHAR',
                'constraint' => 200,
                'null'       => FALSE,
                'comment'    => '缩略图',
            ),
            'is_link'      => array(
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => FALSE,
                'comment'    => '是否外链：0-否 1-是',
                'default'    => 0,
            ),
            'hits'         => array(
                'type'       => 'INT',
                'constraint' => 11,
                'null'       => FALSE,
                'comment'    => '阅读量',
            ),
            'type'         => array(
                'type'       => 'TINYINT',
                'constraint' => 1,
                'null'       => FALSE,
                'default'    => 0,
                'comment'    => '文章类别：0-默认 1-精选 2-专题',
            ),
            'create_time'  => array(
                'type'    => 'DATETIME',
                'null'    => FALSE,
                'default' => 0,
                'comment' => '创建时间',
            ),
            'update_time'  => array(
                'type'    => 'DATETIME',
                'null'    => FALSE,
                'default' => 0,
                'comment' => '更新时间',
            ),
            'publish_time' => array(
                'type'    => 'DATETIME',
                'null'    => FALSE,
                'default' => 0,
                'comment' => '发布时间',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('cid');
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'文章表'",
        );
        $this->dbforge->create_table('t_artcles', TRUE, $attributes);
        
        //================文章标签表====================================
        $this->dbforge->add_field(array(
            'id'       => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => '文章标签ID',
                'auto_increment' => TRUE,
            ),
            'tag_name' => array(
                'type'       => 'VARCHAR',
                'unique'     => TRUE,
                'constraint' => 50,
                'unsigned'   => TRUE,
                'comment'    => '标签名称',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'文章标签表'",
        );
        $this->dbforge->create_table('t_tags', TRUE, $attributes);
        
        //=================文章评论表=========================================
        $this->dbforge->add_field(array(
            'id'          => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => '评论id',
                'auto_increment' => TRUE,
            ),
            'artcle_id'   => array(
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'comment'    => '文章id',
            ),
            'content'     => array(
                'type'       => 'VARCHAR',
                'constraint' => 150,
                'unsigned'   => TRUE,
                'comment'    => '评论内容',
            ),
            'user_id'     => array(
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'comment'    => '用户id',
            ),
            'praise'      => array(
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'comment'    => '被赞数',
            ),
            'pid'         => array(
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'comment'    => '父ID',
            ),
            'create_time' => array(
                'type'     => 'DATETIME',
                'unsigned' => TRUE,
                'default'  => NULL,
                'null'     => TRUE,
                'comment'  => '父ID',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('pid');
        $this->dbforge->add_key('user_id');
        $this->dbforge->add_key('artcle_id');
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'文章评论表'",
        );
        $this->dbforge->create_table('t_comments', TRUE, $attributes);
        
        //===============创建栏目表========================================
        $this->dbforge->add_field(array(
            'id'       => array(
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'comment'        => '文章栏目id',
                'auto_increment' => TRUE,
            ),
            'category' => array(
                'type'       => 'VARCHAR',
                'unique'     => TRUE,
                'constraint' => 50,
                'unsigned'   => TRUE,
                'comment'    => '栏目名称',
            ),
            'pid'      => array(
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => TRUE,
                'comment'    => '父ID',
            ),
            'status'   => array(
                'type'     => 'TINYINT',
                'unsigned' => TRUE,
                'default'  => 0,
                'null'     => TRUE,
                'comment'  => '状态：0-可用 1-不可用',
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $attributes = array(
            'ENGINE'          => 'InnoDB',
            'DEFAULT CHARSET' => 'utf8',
            'COMMENT'         => "'文章栏目表'",
        );
        $this->dbforge->create_table('t_categorys', TRUE, $attributes);
        
        //=====================插入初始化数据===================================
        //插入用户数据
        $userData = array(
            'username'        => 'hexd0070',
            'password'        => '57127ab77527def52dada083e0ce1c0f3eesf2',
            'group_id'        => 0,
            'nick_name'       => '牛盾007',
            'portrait'        => '/public/assets/images/header.png',
            'mobile'          => 15210881179,
            'email'           => 'hexiaodong2810@163.com	',
            'last_login_time' => '2018-08-08 18:11:58',
            'last_login_ip'   => '111.200.218.67',
            'status'          => 0,
        );
        
        $insertUser = $this->db->insert('t_users', $userData);
        if (!$insertUser) {
            write_log('logs/migrate.log', '初始化用户数据错误');
        }
        //插入栏目
        $categoryData = array(
            array(
                'pid'      => 0,
                'category' => '前端开发',
                'status'   => 0,
            ),
            array(
                'pid'      => 0,
                'category' => '后端开发',
                'status'   => 0,
            ),
            array(
                'pid'      => 0,
                'category' => '系统运维',
                'status'   => 0,
            ),
            array(
                'pid'      => 0,
                'category' => '大数据',
                'status'   => 0,
            ),
            array(
                'pid'      => 0,
                'category' => '网站运营',
                'status'   => 0,
            ),
            array(
                'pid'      => 0,
                'category' => '数据库',
                'status'   => 0,
            ),
        );
        
        $insertCategory = $this->db->insert_batch('t_categorys', $categoryData);
        if (!$insertCategory) {
            write_log('logs/migrate.log', '初始化栏目数据错误');
        }
        //插入友情链接
        $linkData = array(
            array(
                'name'        => '想做设计的java',
                'logo'        => NULL,
                'url'         => 'http://www.luotianchang.com',
                'create_time' => '2018-08-08 21:27:40',
                'status'      => 0,
            ),
            array(
                'name'        => '全栈工程师',
                'logo'        => NULL,
                'url'         => 'http://www.liuzhaoning.com',
                'create_time' => '2018-08-08 21:27:40',
                'status'      => 0,
            ),
            array(
                'name'        => '会适配的java',
                'logo'        => NULL,
                'url'         => 'http://www.lvlvstart.com',
                'create_time' => '2018-08-08 21:27:40',
                'status'      => 0,
            ),
            array(
                'name'        => '想做开发的运维',
                'logo'        => NULL,
                'url'         => 'http://www.itwithauto.com',
                'create_time' => '2018-08-08 21:27:40',
                'status'      => 0,
            ),
        );
        
        $insertLink = $this->db->insert_batch('t_friend_links', $linkData);
        if (!$insertLink) {
            write_log('logs/migrate.log', '初始化友情链接数据错误');
        }
        
    }
    
    public function down() {
        $this->dbforge->drop_table('t_users');
        $this->dbforge->drop_table('t_tags_map');
        $this->dbforge->drop_table('t_friend_links');
        $this->dbforge->drop_table('t_artcles');
        $this->dbforge->drop_table('t_tags');
        $this->dbforge->drop_table('t_comments');
        $this->dbforge->drop_table('t_categorys');
    }
}