<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%dynamic_form_data}}`.
 */
class m220331_041128_create_dynamic_form_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%dynamic_form_data}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string(1000),
            'data' => $this->json(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%dynamic_form_data}}');
    }
}
