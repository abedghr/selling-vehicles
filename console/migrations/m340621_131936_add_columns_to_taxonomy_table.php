<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%taxonomy}}`.
 */
class m340621_131936_add_columns_to_taxonomy_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%taxonomy}}', 'is_featured', $this->smallInteger()->defaultValue(0)->after('type'));
        $this->addColumn('{{%taxonomy}}', 'is_popular', $this->smallInteger()->defaultValue(0)->after('is_featured'));
        $this->addColumn('{{%taxonomy}}', 'created_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        $this->addColumn('{{%taxonomy}}', 'updated_at', $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}
