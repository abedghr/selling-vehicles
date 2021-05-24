<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%new_vehicle}}`.
 */
class m270523_073319_create_new_vehicle_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%new_vehicle}}', [
            'vehicle_id' => $this->integer()->notNull(),
            'engine_id' => $this->integer()->notNull(),
            'gasoline_amount_id' => $this->integer()->notNull(),
            'wheels_size_id' => $this->integer()->notNull(),
            'light_type_id' => $this->integer()->notNull(),
            'propulsion_system_id' => $this->integer()->notNull(),
            'fuel_type_id' => $this->integer()->notNull(),
            'engine_capacity' => $this->string(10)->notNull(),
            'video_url' => $this->string()->notNull(),
            'horse_power' => $this->string()->notNull(),
        ]);
        $this->addPrimaryKey('new-vehicle_id_PK','new_vehicle','vehicle_id');
        $this->addForeignKey('vehicle_id_FK','new_vehicle','vehicle_id','vehicle','id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%new_vehicle}}');
    }
}
