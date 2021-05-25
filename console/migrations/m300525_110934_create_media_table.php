<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%media}}`.
 */
class m300525_110934_create_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%media}}', [
            'id' => $this->primaryKey(),
            'image' => $this->string(500)->notNull(),
            'user_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('media_user_id_FK','media','user_id','user','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%media}}');
    }
}
