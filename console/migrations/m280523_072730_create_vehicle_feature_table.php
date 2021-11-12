<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicle_feature}}`.
 */
class m280523_072730_create_vehicle_feature_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vehicle_feature}}', [
            'vehicle_id' => $this->integer()->notNull(),
            'taxonomy_id' => $this->integer()->notNull(),
        ]);

        $this->addPrimaryKey('vehicle_taxonomy_PK','vehicle_feature',['vehicle_id','taxonomy_id']);
        $this->addForeignKey('vehicle_feature_FK','vehicle_feature','vehicle_id','vehicle','id','cascade','cascade');
        $this->addForeignKey('vehicle_feature_tax_FK','vehicle_feature','taxonomy_id','taxonomy','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vehicle_feature}}');
    }
}
