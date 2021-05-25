<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicle_media}}`.
 */
class m310525_115802_create_vehicle_media_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vehicle_media}}', [
            'vehicle_id' => $this->integer()->notNull(),
            'media_id' => $this->integer()->notNull()
        ]);

        $this->addForeignKey('vm_vehicle_id_FK','vehicle_media','vehicle_id','vehicle','id','cascade','cascade');
        $this->addForeignKey('vm_media_id_FK','vehicle_media','media_id','media','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vehicle_media}}');
    }
}
