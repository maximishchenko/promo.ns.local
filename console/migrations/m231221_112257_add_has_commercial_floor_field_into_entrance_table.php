<?php

use yii\db\Migration;

class m231221_112257_add_has_commercial_floor_field_into_entrance_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%entrance}}', 'has_commercial_floor', $this->smallInteger()->defaultValue(0));
        $this->createIndex('idx-entrance-has_commercial_floor', '{{%entrance}}', 'has_commercial_floor');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%entrance}}', 'has_commercial_floor');
    }
}
