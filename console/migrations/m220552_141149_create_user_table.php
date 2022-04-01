<?php

use yii\db\Migration;

class m220552_141149_create_user_table extends Migration
{
    public function SafeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),
            'type' => $this->string(100)->notNull(),
            'phone' => $this->string(15)->notNull(),
            'phone2' => $this->string(15)->null(),
            'city_id' => $this->integer()->null(),
            'location' => $this->string(500)->null(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'is_deleted' => $this->tinyInteger()->notNull()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);

        $this->createIndex('username_index','user','username');
        $this->createIndex('email_index','user','email');
        $this->createIndex('phone_index','user','phone');
        $this->addForeignKey('tax_city_id_FK', 'user', 'city_id', 'taxonomy', 'id', 'SET NULL', 'cascade');
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
