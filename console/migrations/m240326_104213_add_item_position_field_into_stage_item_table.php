<?php

use yii\db\Migration;

/**
 * Class m240326_104213_add_item_position_field_into_stage_item_table
 */
class m240326_104213_add_item_position_field_into_stage_item_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $this->addColumn('{{%stage_item}}', 'position', $this->string()->notNull());
        $this->createIndex('idx-stage_item-position', '{{%stage_item}}', 'position');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%stage_item}}', 'position');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240326_104213_add_item_position_field_into_stage_item_table cannot be reverted.\n";

        return false;
    }
    */
}
