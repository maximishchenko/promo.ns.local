<?php

use yii\db\Migration;

class m241016_074846_add_image_field_into_gallery_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%gallery}}', 'image', $this->integer());
        $this->createIndex('idx-gallery-image', '{{%gallery}}', 'image');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%gallery}}', 'image');
    }
}
