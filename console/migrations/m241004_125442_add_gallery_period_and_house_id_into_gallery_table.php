<?php

use yii\db\Migration;

/**
 * 
 * Class m241004_125442_add_gallery_period_and_house_id_into_gallery_table
 */
class m241004_125442_add_gallery_period_and_house_id_into_gallery_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn('{{%gallery}}', 'period_month', $this->integer());
        $this->addColumn('{{%gallery}}', 'period_year', $this->integer());
        $this->addColumn('{{%gallery}}', 'house_id', $this->integer()->notNull());
        $this->createIndex('idx-gallery-period_month', '{{%gallery}}', 'period_month');
        $this->createIndex('idx-gallery-period_year', '{{%gallery}}', 'period_year');
        $this->createIndex('idx-gallery-house_id', '{{%gallery}}', 'house_id');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%gallery}}', 'period_month');
        $this->dropColumn('{{%gallery}}', 'period_year');
        $this->dropColumn('{{%gallery}}', 'house_id');
    }
}
