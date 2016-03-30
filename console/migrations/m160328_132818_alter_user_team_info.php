<?php

use yii\db\Migration;
use yii\db\Schema;

class m160328_132818_alter_user_team_info extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user_team_info}}', 'id', Schema::TYPE_PK . ' FIRST');
        $this->alterColumn('{{%user_team_info}}', 'left_time', Schema::TYPE_INTEGER . ' unsigned');
    }

    public function down()
    {
        $this->dropColumn('{{%user_team_info}}', 'id');
        $this->alterColumn('{{%user_team_info}}', 'left_time', Schema::TYPE_INTEGER . ' unsigned NOT NULL');
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
