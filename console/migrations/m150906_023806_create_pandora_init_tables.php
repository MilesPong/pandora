<?php

use yii\db\Migration;

class m150906_023806_create_pandora_init_tables extends Migration
{
//     public function up()
//     {

//     }

//     public function down()
//     {
//         echo "m150906_023806_create_pandora_init_tables cannot be reverted.\n";

//         return false;
//     }

    
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    	$tables = Yii::$app->db->schema->getTableNames();
    	$dbType = $this->db->driverName;
    	$tableOptions_mysql = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
    	$tableOptions_mssql = "";
    	$tableOptions_pgsql = "";
    	$tableOptions_sqlite = "";
    	/* MYSQL */
    	if (!in_array('mp_area_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%area_info}}', [
    					'area_id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
    					0 => 'PRIMARY KEY (`area_id`)',
    					'area_name' => 'VARCHAR(25) NOT NULL',
    					'position_lng' => 'VARCHAR(255) NULL',
    					'position_lat' => 'VARCHAR(255) NULL',
    					'memo' => 'TEXT NULL',
    					'status' => 'ENUM(\'-1\',\'0\',\'1\') NOT NULL DEFAULT \'1\'',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_fee_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%fee_info}}', [
    					'fee_id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
    					0 => 'PRIMARY KEY (`fee_id`)',
    					'match_id' => 'INT(10) UNSIGNED NOT NULL',
    					'income' => 'SMALLINT(5) UNSIGNED NOT NULL',
    					'expense' => 'SMALLINT(5) UNSIGNED NOT NULL',
    					'remain' => 'MEDIUMINT(9) NOT NULL',
    					'memo' => 'TEXT NOT NULL',
    					'status' => 'ENUM(\'-1\',\'0\',\'1\') NOT NULL DEFAULT \'1\'',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_judge_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%judge_info}}', [
    					'match_id' => 'INT(10) UNSIGNED NOT NULL',
    					0 => 'PRIMARY KEY (`match_id`)',
    					'referee' => 'VARCHAR(25) NOT NULL',
    					'assistant' => 'VARCHAR(25) NULL',
    					'lineman1' => 'VARCHAR(25) NULL',
    					'lineman2' => 'VARCHAR(25) NULL',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_match_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%match_info}}', [
    					'match_id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
    					0 => 'PRIMARY KEY (`match_id`)',
    					'area_id' => 'INT(10) UNSIGNED NOT NULL',
    					'home_id' => 'INT(10) UNSIGNED NOT NULL',
    					'home_score' => 'TINYINT(4) UNSIGNED NOT NULL',
    					'visters_id' => 'INT(10) UNSIGNED NOT NULL',
    					'visters_score' => 'TINYINT(4) UNSIGNED NOT NULL',
    					'hold_time' => 'INT(10) UNSIGNED NOT NULL',
    					'full_time' => 'VARCHAR(25) NOT NULL',
    					'memo' => 'TEXT NULL',
    					'status' => 'ENUM(\'-1\',\'0\',\'1\') NOT NULL DEFAULT \'1\'',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_match_user_detail', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%match_user_detail}}', [
    					'match_id' => 'INT(10) UNSIGNED NOT NULL',
    					'uid' => 'INT(10) UNSIGNED NOT NULL',
    					'goal' => 'TINYINT(3) UNSIGNED NULL',
    					'assist' => 'TINYINT(3) UNSIGNED NULL',
    					'yellow' => 'TINYINT(3) UNSIGNED NULL',
    					'red' => 'TINYINT(3) UNSIGNED NULL',
    					'is_vip' => 'ENUM(\'0\',\'1\') NOT NULL',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_position_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%position_info}}', [
    					'position_id' => 'TINYINT(4) UNSIGNED NOT NULL AUTO_INCREMENT',
    					0 => 'PRIMARY KEY (`position_id`)',
    					'position_name' => 'VARCHAR(25) NOT NULL',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_team_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%team_info}}', [
    					'team_id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
    					0 => 'PRIMARY KEY (`team_id`)',
    					'team_name' => 'VARCHAR(25) NOT NULL',
    					'captain_id' => 'INT(10) UNSIGNED NULL',
    					'manager' => 'VARCHAR(25) NOT NULL',
    					'rank' => 'TINYINT(4) UNSIGNED NOT NULL DEFAULT \'1\'',
    					'memo' => 'TEXT NULL',
    					'status' => 'ENUM(\'-1\',\'0\',\'1\') NOT NULL DEFAULT \'1\'',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_user_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%user_info}}', [
    					'uid' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
    					0 => 'PRIMARY KEY (`uid`)',
    					'user_id' => 'INT(11) NULL',
    					'truename' => 'VARCHAR(25) NOT NULL',
    					'birthday' => 'INT(10) UNSIGNED NULL',
    					'phone' => 'VARCHAR(32) NULL',
    					'email' => 'VARCHAR(255) NULL',
    					'qq' => 'VARCHAR(15) NULL',
    					'address' => 'VARCHAR(255) NULL',
    					'team_id' => 'INT(10) UNSIGNED NULL',
    					'avatar' => 'VARCHAR(255) NULL',
    					'created_at' => 'INT(11) UNSIGNED NOT NULL',
    					'updated_at' => 'INT(11) UNSIGNED NOT NULL',
    					'memo' => 'TEXT NULL',
    					'status' => 'ENUM(\'-1\',\'0\',\'1\') NOT NULL DEFAULT \'1\'',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	/* MYSQL */
    	if (!in_array('mp_user_team_info', $tables))  {
    		if ($dbType == "mysql") {
    			$this->createTable('{{%user_team_info}}', [
    					'uid' => 'INT(10) UNSIGNED NOT NULL',
    					'team_id' => 'INT(10) UNSIGNED NOT NULL',
    					'join_time' => 'INT(10) UNSIGNED NOT NULL',
    					'left_time' => 'INT(10) UNSIGNED NOT NULL',
    					'position_id' => 'TINYINT(4) UNSIGNED NOT NULL',
    					'number' => 'INT(10) UNSIGNED NOT NULL',
    					'status' => 'ENUM(\'-1\',\'0\',\'1\') NOT NULL DEFAULT \'1\'',
    			], $tableOptions_mysql);
    		}
    	}
    	
    	
    	$this->createIndex('idx_match_id_7951_00','mp_fee_info','match_id',0);
    	$this->createIndex('idx_match_id_7951_01','mp_fee_info','match_id',0);
    	$this->createIndex('idx_UNIQUE_match_id_7965_02','mp_judge_info','match_id',1);
    	$this->createIndex('idx_area_id_7981_03','mp_match_info','area_id',0);
    	$this->createIndex('idx_home_id_7981_04','mp_match_info','home_id',0);
    	$this->createIndex('idx_visters_id_7981_05','mp_match_info','visters_id',0);
    	$this->createIndex('idx_match_id_7993_06','mp_match_user_detail','match_id',0);
    	$this->createIndex('idx_uid_7993_07','mp_match_user_detail','uid',0);
    	$this->createIndex('idx_captain_id_8013_08','mp_team_info','captain_id',0);
    	$this->createIndex('idx_team_id_8027_09','mp_user_info','team_id',0);
    	$this->createIndex('idx_user_id_8027_10','mp_user_info','user_id',0);
    	$this->createIndex('idx_uid_8042_11','mp_user_team_info','uid',0);
    	$this->createIndex('idx_team_id_8042_12','mp_user_team_info','team_id',0);
    	$this->createIndex('idx_position_id_8042_13','mp_user_team_info','position_id',0);
    	
    	$this->execute('SET foreign_key_checks = 0');
    	$this->addForeignKey('fk_mp_match_info_7949_00','{{%fee_info}}', 'match_id', '{{%match_info}}', 'match_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_match_info_7963_01','{{%judge_info}}', 'match_id', '{{%match_info}}', 'match_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_area_info_7978_02','{{%match_info}}', 'area_id', '{{%area_info}}', 'area_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_team_info_7978_03','{{%match_info}}', 'home_id', '{{%team_info}}', 'team_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_team_info_7978_04','{{%match_info}}', 'visters_id', '{{%team_info}}', 'team_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_match_info_7991_05','{{%match_user_detail}}', 'match_id', '{{%match_info}}', 'match_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_user_info_7991_06','{{%match_user_detail}}', 'uid', '{{%user_info}}', 'uid', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_user_info_8012_07','{{%team_info}}', 'captain_id', '{{%user_info}}', 'uid', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_team_info_8025_08','{{%user_info}}', 'team_id', '{{%team_info}}', 'team_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_user_8025_09','{{%user_info}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_position_info_804_010','{{%user_team_info}}', 'position_id', '{{%position_info}}', 'position_id', 'RESTRICT', 'CASCADE' );
    	$this->addForeignKey('fk_mp_team_info_804_011','{{%user_team_info}}', 'team_id', '{{%team_info}}', 'team_id', 'RESTRICT', 'CASCADE' );
    	$this->execute('SET foreign_key_checks = 1;');
    }

    public function safeDown()
    {
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_area_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_fee_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_judge_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_match_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_match_user_detail`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_position_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_team_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_user_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    	$this->execute('SET foreign_key_checks = 0');
    	$this->execute('DROP TABLE IF EXISTS `mp_user_team_info`');
    	$this->execute('SET foreign_key_checks = 1;');
    }
    
}
