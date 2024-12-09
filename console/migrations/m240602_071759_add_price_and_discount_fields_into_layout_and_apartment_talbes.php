<?php

use yii\db\Migration;

/**
 * Class m240602_071759_add_price_and_discount_fields_into_layout_and_apartment_talbes
 */
class m240602_071759_add_price_and_discount_fields_into_layout_and_apartment_talbes extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%layout}}', 'price', $this->decimal(65, 2)->notNull()->defaultValue(0));
        $this->addColumn('{{%layout}}', 'discount', $this->integer()->notNull()->defaultValue(0));
        $this->addColumn('{{%apartment}}', 'price', $this->decimal(65, 2)->notNull()->defaultValue(0));
        $this->addColumn('{{%apartment}}', 'discount', $this->integer()->notNull()->defaultValue(0));
        $this->createIndex('idx-layout-price', '{{%layout}}', 'price');
        $this->createIndex('idx-layout-discount', '{{%layout}}', 'discount');
        $this->createIndex('idx-apartment-price', '{{%apartment}}', 'price');
        $this->createIndex('idx-apartment-discount', '{{%apartment}}', 'discount');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%layout}}', 'price');
        $this->dropColumn('{{%layout}}', 'discount');
        $this->dropColumn('{{%apartment}}', 'price');
        $this->dropColumn('{{%apartment}}', 'discount');
    }
}
