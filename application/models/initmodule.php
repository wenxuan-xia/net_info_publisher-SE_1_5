<?php 

class Initmodule extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    

    function init_database(){
		$this->load->dbforge();
	
		//创建用户表（用户各信息）
		$this->dbforge->add_field("id int primary key AUTO_INCREMENT");
		$this->dbforge->add_field("name char(32) NOT NULL UNIQUE");
		$this->dbforge->add_field("password char(32) NOT NULL");
		$this->dbforge->add_field("email varchar(255) NOT NULL");
		$this->dbforge->add_field("realname char(32) NOT NULL DEFAULT ''");
		$this->dbforge->add_field("permission timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->create_table('users',TRUE);
		
		//创建表（储存登陆用户的token）
		$this->dbforge->add_field("id int NOT NULL");
		$this->dbforge->add_field("token char(32) NOT NULL  primary key ");
		$this->dbforge->add_field("activetime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
		$this->dbforge->add_field("countnum int");
		$this->dbforge->create_table('userlogin', TRUE);
	
		//创建表（储存通过邮箱重置密码的token）
		$this->dbforge->add_field("id int primary key AUTO_INCREMENT");
		$this->dbforge->add_field("urltoken char(32) NOT NULL");
		$this->dbforge->add_field("validtime timestamp NOT NULL");
		$this->dbforge->create_table('reset_url', TRUE);
		
		//创建充值记录表
		$this->dbforge->add_field("id int primary key AUTO_INCREMENT");
		$this->dbforge->add_field("userid int NOT NULL");
		$this->dbforge->add_field("amount int NOT NULL");
		$this->dbforge->add_field("phone char(11) NOT NULL");
		$this->dbforge->add_field("attime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->create_table('rechargelog', TRUE);
		 
		//创建收藏/搜索记录表 （根据实际情况修改）
		$this->dbforge->add_field("id int primary key AUTO_INCREMENT");
		$this->dbforge->add_field("userid int NOT NULL");
		$this->dbforge->add_field("code char(32) NOT NULL");
		$this->dbforge->add_field("name char(32) NOT NULL");
		$this->dbforge->add_field("attime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->create_table('searchlog', TRUE);
    	
		//创建收藏记录表 （根据实际情况修改）
		$this->dbforge->add_field("id int primary key AUTO_INCREMENT");
		$this->dbforge->add_field("userid int NOT NULL");
		$this->dbforge->add_field("code char(32) NOT NULL");
		$this->dbforge->add_field("attime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
		$this->dbforge->create_table("bookmark", TRUE);

    	/**
		outer tables for temp_use
    	**/
   		//创建stock_metax表，实际上是外数据库，仅仅在这里模拟
    	$this->dbforge->add_field("stock_id int primary key AUTO_INCREMENT");
		$this->dbforge->add_field("stock_name varchar(11) NOT NULL");
		$this->dbforge->add_field("currency varchar(11) NOT NULL");
		$this->dbforge->add_field("price double NOT NULL");
		$this->dbforge->add_field("volume int NOT NULL");
		$this->dbforge->add_field("state int NOT NULL");
		$this->dbforge->create_table('stock_meta', TRUE);
    }
}?>