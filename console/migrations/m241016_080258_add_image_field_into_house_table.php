<?php

use yii\db\Migration;

class m241016_080258_add_image_field_into_house_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%house}}', 'image', $this->string());
        $this->createIndex('idx-house-image', '{{%house}}', 'image');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%house}}', 'image');
    }
}
