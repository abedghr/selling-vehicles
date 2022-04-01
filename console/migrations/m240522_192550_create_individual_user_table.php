<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%individual_user}}`.
 */
class m240522_192550_create_individual_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%individual_user}}', [
            'user_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'first_name_en' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'last_name_en' => $this->string()->notNull(),
        ]);

        $this->addPrimaryKey('individual_user_id_PK','individual_user','user_id');

        $this->addForeignKey('individual_user_id_FK', 'individual_user', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%individual_user}}');
    }
}
