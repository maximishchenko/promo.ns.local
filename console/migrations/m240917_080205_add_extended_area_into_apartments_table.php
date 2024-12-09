<?php

use yii\db\Migration;

/**
 * Class m240917_080205_add_extended_area_into_apartments_table
 */
class m240917_080205_add_extended_area_into_apartments_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%apartment}}', 'extended_total_area', $this->decimal(65, 2)->null());
        $this->addColumn('{{%apartment}}', 'extended_count_rooms', $this->integer()->null());
        $this->createIndex('idx-apartment-extended_total_area', '{{%apartment}}', 'extended_total_area');
        $this->createIndex('idx-apartment-extended_count_rooms', '{{%apartment}}', 'extended_count_rooms');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%apartment}}', 'extended_total_area');
        $this->dropColumn('{{%apartment}}', 'extended_count_rooms');
    }
}
