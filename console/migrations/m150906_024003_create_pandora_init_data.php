<?php

use yii\db\Migration;

class m150906_024003_create_pandora_init_data extends Migration
{
    public function up()
    {
    	$this->execute('SET foreign_key_checks = 0');
    	$this->insert('{{%mp_team_info}}',['team_id'=>'4','team_name'=>'珠海明珠足球队','captain_id'=>'2','manager'=>'秦涛国','rank'=>'1','memo'=>'','status'=>'1']);
    	$this->insert('{{%mp_team_info}}',['team_id'=>'5','team_name'=>'巴萨罗纳','captain_id'=>'5','manager'=>'瓜迪奥拉','rank'=>'1','memo'=>'Messi','status'=>'1']);
    	$this->insert('{{%mp_user_info}}',['uid'=>'1','user_id'=>'','truename'=>'秦涛国','birthday'=>'1439510400','phone'=>'','email'=>'','qq'=>'','address'=>'','team_id'=>'','avatar'=>'','created_at'=>'0','updated_at'=>'1440733051','memo'=>'','status'=>'1']);
    	$this->insert('{{%mp_user_info}}',['uid'=>'2','user_id'=>'','truename'=>'刘巧明','birthday'=>'1439424000','phone'=>'','email'=>'','qq'=>'','address'=>'','team_id'=>'4','avatar'=>'','created_at'=>'0','updated_at'=>'1440742432','memo'=>'','status'=>'1']);
    	$this->insert('{{%mp_user_info}}',['uid'=>'3','user_id'=>'','truename'=>'黄小湖','birthday'=>'','phone'=>'','email'=>'','qq'=>'','address'=>'','team_id'=>'4','avatar'=>'','created_at'=>'0','updated_at'=>'1440730036','memo'=>'','status'=>'1']);
    	$this->insert('{{%mp_user_info}}',['uid'=>'4','user_id'=>'','truename'=>'付勇','birthday'=>'0','phone'=>'','email'=>'','qq'=>'','address'=>'','team_id'=>'4','avatar'=>'','created_at'=>'1440730063','updated_at'=>'1440730063','memo'=>'','status'=>'1']);
    	$this->insert('{{%mp_user_info}}',['uid'=>'5','user_id'=>'1','truename'=>'梅西','birthday'=>'1439856000','phone'=>'15876655243','email'=>'mingpeng16@gamil.com','qq'=>'344841605','address'=>'广东省珠海市香洲区南屏','team_id'=>'4','avatar'=>'','created_at'=>'1440730925','updated_at'=>'1440743730','memo'=>'Barsalona','status'=>'1']);
    	$this->insert('{{%mp_user_info}}',['uid'=>'6','user_id'=>'','truename'=>'普约尔','birthday'=>'523497600','phone'=>'','email'=>'puyuer@twitter.com','qq'=>'','address'=>'','team_id'=>'4','avatar'=>'','created_at'=>'1440745076','updated_at'=>'1440745076','memo'=>'Captain','status'=>'0']);
    	$this->execute('SET foreign_key_checks = 1;');
    }

    public function down()
    {
        echo "m150906_024003_create_pandora_init_data cannot be reverted.\n";

        return false;
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
