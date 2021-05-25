<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%used_vehicle}}`.
 */
class m290524_195341_create_used_vehicle_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%used_vehicle}}', [
            'vehicle_id' => $this->integer()->notNull(),
            'city_id' => $this->integer()->notNull(),
            'mileage_id' => $this->integer()->notNull(),
            'vehicle_checking_id' => $this->integer()->notNull()
        ]);

        $this->addPrimaryKey('used-vehicle_id_PK','used_vehicle','vehicle_id');
        $this->addForeignKey('used_vehicle_id_FK','used_vehicle','vehicle_id','vehicle','id');
        $this->addForeignKey('tax_used_vehicle_city_id_FK','used_vehicle','city_id','taxonomy','id');
        $this->addForeignKey('tax_mileage_id_FK','used_vehicle','mileage_id','taxonomy','id');
        $this->addForeignKey('tax_vehicle_checking_id_FK','used_vehicle','vehicle_checking_id','taxonomy','id');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%used_vehicle}}');
    }
}
