<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%company}}`.
 */
class m250522_193749_create_company_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%company}}', [
            'user_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'name_en' => $this->string()->notNull(),
            'vehicles_type' => $this->string()->notNull(),
            'image' => $this->string(500)->null(),
            'description' => $this->text(),
            'description_en' => $this->text(),
            'branch_number' => $this->smallInteger()->defaultValue(1)
        ]);

        $this->addPrimaryKey('company_user_id_PK','company','user_id');

        $this->addForeignKey('company_user_id_FK', 'company', 'user_id', 'user', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%company}}');
    }
}
