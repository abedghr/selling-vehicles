<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%taxonomy}}`.
 */
class m210522_141149_create_taxonomy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%taxonomy}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer()->null(),
            'title' => $this->string()->notNull(),
            'title_en' => $this->string()->notNull(),
            'type' => $this->string()->notNull(),
            'image' => $this->string(500)->null()
        ]);

        $this->createIndex("Type_index",'taxonomy','type');
        $this->addForeignKey('taxonomy_parent_FK','taxonomy','parent_id','taxonomy','id','cascade','cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%taxonomy}}');
    }
}
