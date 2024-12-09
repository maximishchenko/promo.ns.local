<?php

use yii\db\Migration;


class m240926_125841_add_extended_layout_image_into_apartments_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%apartment}}', 'extended_layout_image', $this->string());
        $this->createIndex('idx-apartment-extended_layout_image', '{{%apartment}}', 'extended_layout_image');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%apartment}}', 'extended_layout_image');
    }
}
