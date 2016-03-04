<?php

use yii\db\Migration;
use yii\db\Schema;

class m160304_014849_alter_status_type extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%team_info}}', 'status', Schema::TYPE_BOOLEAN . ' unsigned NOT NULL DEFAULT 1');
        $this->alterColumn('{{%area_info}}', 'status', Schema::TYPE_BOOLEAN . ' unsigned NOT NULL DEFAULT 1');
        $this->alterColumn('{{%fee_info}}', 'status', Schema::TYPE_BOOLEAN . ' unsigned NOT NULL DEFAULT 1');
        $this->alterColumn('{{%match_info}}', 'status', Schema::TYPE_BOOLEAN . ' unsigned NOT NULL DEFAULT 1');
        $this->alterColumn('{{%user_team_info}}', 'status', Schema::TYPE_BOOLEAN . ' unsigned NOT NULL DEFAULT 1');
        $this->alterColumn('{{%user_info}}', 'status', Schema::TYPE_BOOLEAN . ' unsigned NOT NULL DEFAULT 1');
    }

    public function down()
    {
        $this->alterColumn('{{%team_info}}', 'status', 'ENUM(\'-1\', \'0\', \'1\') NOT NULL DEFAULT \'1\'');
        $this->alterColumn('{{%area_info}}', 'status', 'ENUM(\'-1\', \'0\', \'1\') NOT NULL DEFAULT \'1\'');
        $this->alterColumn('{{%fee_info}}', 'status', 'ENUM(\'-1\', \'0\', \'1\') NOT NULL DEFAULT \'1\'');
        $this->alterColumn('{{%match_info}}', 'status', 'ENUM(\'-1\', \'0\', \'1\') NOT NULL DEFAULT \'1\'');
        $this->alterColumn('{{%user_team_info}}', 'status', 'ENUM(\'-1\', \'0\', \'1\') NOT NULL DEFAULT \'1\'');
        $this->alterColumn('{{%user_info}}', 'status', 'ENUM(\'-1\', \'0\', \'1\') NOT NULL DEFAULT \'1\'');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
