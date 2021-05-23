<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vehicle}}`.
 */
class m260523_062330_create_vehicle_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vehicle}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'make_id' => $this->integer()->notNull(),
            'model_id' => $this->integer()->notNull(),
            'color_id' => $this->integer()->notNull(),
            'body_type_id' => $this->integer()->notNull(),
            'gear_box_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'title_en' => $this->string()->notNull(),
            'price' => $this->string(30)->notNull(),
            'description' => $this->text()->notNull(),
            'description_en' => $this->text()->notNull(),
            'main_image' => $this->string(500)->notNull(),
            'type' => $this->string(100)->notNull(),
            'status' => $this->string(50)->defaultValue('pending'),
            'manufacturing_year' => $this->string(4),
            'is_deleted' => $this->tinyInteger()->defaultValue(0),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->addForeignKey('v_user_id_FK','vehicle','user_id','user','id');
        $this->addForeignKey('v_make_id_FK','vehicle','make_id','taxonomy','id');
        $this->addForeignKey('v_model_id_FK','vehicle','model_id','taxonomy','id');
        $this->addForeignKey('v_color_id_FK','vehicle','color_id','taxonomy','id');
        $this->addForeignKey('v_body_type_id_FK','vehicle','body_type_id','taxonomy','id');
        $this->addForeignKey('v_gear_box_id_FK','vehicle','gear_box_id','taxonomy','id');

        $this->createIndex('v_year_index','vehicle','manufacturing_year');
        $this->createIndex('v_make_model_year_type_index','vehicle',['make_id','model_id','manufacturing_year','type']);
        $this->createIndex('v_year_make_model_type_index','vehicle',['manufacturing_year','make_id','model_id','type']);
        $this->createIndex('v_make_year_index','vehicle',['make_id','manufacturing_year']);
        $this->createIndex('v_make_type_index','vehicle',['make_id','type']);
        $this->createIndex('v_year_type_index','vehicle',['manufacturing_year','type']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%vehicle}}');
    }
}
