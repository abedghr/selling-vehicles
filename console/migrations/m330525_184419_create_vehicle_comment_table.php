<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicle_comment}}`.
 */
class m330525_184419_create_vehicle_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vehicle_comment}}', [
            'vehicle_id' => $this->integer()->notNull(),
            'comment_id' => $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('vehicle_and_comment_PK', 'vehicle_comment', ['vehicle_id', 'comment_id']);
        $this->addForeignKey('vc_vehicle_id_FK', 'vehicle_comment', 'vehicle_id', 'vehicle', 'id','cascade','cascade');
        $this->addForeignKey('vc_comment_id_FK', 'vehicle_comment', 'comment_id', 'comment', 'id','cascade','cascade');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vehicle_comment}}');
    }
}
