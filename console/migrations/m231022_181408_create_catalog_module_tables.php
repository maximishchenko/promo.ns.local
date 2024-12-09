<?php

use yii\db\Migration;

class m231022_181408_create_catalog_module_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%house}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-house-id', '{{%house}}', 'id');
        $this->createIndex('idx-house-name', '{{%house}}', 'name');
        $this->createIndex('idx-house-sort', '{{%house}}', 'sort');
        $this->createIndex('idx-house-status', '{{%house}}', 'status');
        $this->createIndex('idx-house-created_at', '{{%house}}', 'created_at');
        $this->createIndex('idx-house-updated_at', '{{%house}}', 'updated_at');
        $this->createIndex('idx-house-created_by', '{{%house}}', 'created_by');
        $this->createIndex('idx-house-updated_by', '{{%house}}', 'updated_by');

        $this->createTable('{{%entrance}}', [
            'id' => $this->primaryKey(),
            'house_id' => $this->integer()->notNull(),
            'number' => $this->integer()->notNull(),
            'count_floors' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-entrance-id', '{{%entrance}}', 'id');
        $this->createIndex('idx-entrance-house_id', '{{%entrance}}', 'house_id');
        $this->createIndex('idx-entrance-number', '{{%entrance}}', 'number');
        $this->createIndex('idx-entrance-count_floors', '{{%entrance}}', 'count_floors');
        $this->createIndex('idx-entrance-sort', '{{%entrance}}', 'sort');
        $this->createIndex('idx-entrance-status', '{{%entrance}}', 'status');
        $this->createIndex('idx-entrance-created_at', '{{%entrance}}', 'created_at');
        $this->createIndex('idx-entrance-updated_at', '{{%entrance}}', 'updated_at');
        $this->createIndex('idx-entrance-created_by', '{{%entrance}}', 'created_by');
        $this->createIndex('idx-entrance-updated_by', '{{%entrance}}', 'updated_by');

        $this->addForeignKey('fk-entrance-house', '{{%entrance}}', 'house_id', '{{%house}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%layout}}', [
            'id' => $this->primaryKey(),
            'entrance_id' => $this->integer()->notNull(),
            'image' => $this->string(),
            'count_rooms' => $this->integer()->notNull(),
            'total_area' => $this->decimal(65, 2)->notNull(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-layout-id', '{{%layout}}', 'id');
        $this->createIndex('idx-layout-entrance_id', '{{%layout}}', 'entrance_id');
        $this->createIndex('idx-layout-image', '{{%layout}}', 'image');
        $this->createIndex('idx-layout-count_rooms', '{{%layout}}', 'count_rooms');
        $this->createIndex('idx-layout-total_area', '{{%layout}}', 'total_area');
        $this->createIndex('idx-layout-sort', '{{%layout}}', 'sort');
        $this->createIndex('idx-layout-status', '{{%layout}}', 'status');
        $this->createIndex('idx-layout-created_at', '{{%layout}}', 'created_at');
        $this->createIndex('idx-layout-updated_at', '{{%layout}}', 'updated_at');
        $this->createIndex('idx-layout-created_by', '{{%layout}}', 'created_by');
        $this->createIndex('idx-layout-updated_by', '{{%layout}}', 'updated_by');

        $this->addForeignKey('fk-layout-entrance', '{{%layout}}', 'entrance_id', '{{%entrance}}', 'id', 'CASCADE', 'RESTRICT');
        
        $this->createTable('{{%apartment}}', [
            'id' => $this->primaryKey(),
            'layout_id' => $this->integer()->notNull(),
            'number' => $this->integer()->notNull(),
            'apartment_floor' => $this->integer()->notNull(),
            'slug' => $this->string(),
            'image' => $this->string(),
            'sale_status' => $this->string()->notNull(),
            'status' => $this->smallInteger(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-apartment-id', '{{%apartment}}', 'id');
        $this->createIndex('idx-apartment-layout_id', '{{%apartment}}', 'layout_id');
        $this->createIndex('idx-apartment-slug', '{{%apartment}}', 'slug');
        $this->createIndex('idx-apartment-number', '{{%apartment}}', 'number');
        $this->createIndex('idx-apartment-apartment_floor', '{{%apartment}}', 'apartment_floor');
        $this->createIndex('idx-apartment-image', '{{%apartment}}', 'image');
        $this->createIndex('idx-apartment-status', '{{%apartment}}', 'status');
        $this->createIndex('idx-apartment-sale_status', '{{%apartment}}', 'sale_status');
        $this->createIndex('idx-apartment-sort', '{{%apartment}}', 'sort');
        $this->createIndex('idx-apartment-created_at', '{{%apartment}}', 'created_at');
        $this->createIndex('idx-apartment-updated_at', '{{%apartment}}', 'updated_at');
        $this->createIndex('idx-apartment-created_by', '{{%apartment}}', 'created_by');
        $this->createIndex('idx-apartment-updated_by', '{{%apartment}}', 'updated_by');

        $this->addForeignKey('fk-apartment-layout', '{{%apartment}}', 'layout_id', '{{%layout}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function safeDown()
    {
        $this->dropTable('{{%apartment}}');
        $this->dropTable('{{%layout}}');
        $this->dropTable('{{%entrance}}');
        $this->dropTable('{{%house}}');
    }
}
