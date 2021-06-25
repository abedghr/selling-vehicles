<?php

use yii\db\Migration;

/**
 * Class m210621_132839_add_column_slug_to_vehicle_table
 */
class m350621_132839_add_column_slug_to_vehicle_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%vehicle}}', 'slug', $this->string()->defaultValue(null)->after('id'));
        $this->addColumn('{{%vehicle}}', 'slug_en', $this->string()->defaultValue(null)->after('slug'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210621_132839_add_column_slug_to_vehicle_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210621_132839_add_column_slug_to_vehicle_table cannot be reverted.\n";

        return false;
    }
    */
}
