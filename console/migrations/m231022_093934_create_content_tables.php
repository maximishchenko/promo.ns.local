<?php

use yii\db\Migration;

class m231022_093934_create_content_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%stage}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'image' => $this->string(),
            'text' => $this->text(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-stage-id', '{{%stage}}', 'id');
        $this->createIndex('idx-stage-name', '{{%stage}}', 'name');
        $this->createIndex('idx-stage-image', '{{%stage}}', 'image');
        $this->createIndex('idx-stage-sort', '{{%stage}}', 'sort');
        $this->createIndex('idx-stage-status', '{{%stage}}', 'status');
        $this->createIndex('idx-stage-created_at', '{{%stage}}', 'created_at');
        $this->createIndex('idx-stage-updated_at', '{{%stage}}', 'updated_at');
        $this->createIndex('idx-stage-created_by', '{{%stage}}', 'created_by');
        $this->createIndex('idx-stage-updated_by', '{{%stage}}', 'updated_by');
        
        $this->createTable('{{%stage_item}}', [
            'id' => $this->primaryKey(),
            'stage_id' => $this->integer(),
            'name' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-stage_item-id', '{{%stage_item}}', 'id');
        $this->createIndex('idx-stage_item-stage_id', '{{%stage_item}}', 'stage_id');
        $this->createIndex('idx-stage_item-name', '{{%stage_item}}', 'name');
        $this->createIndex('idx-stage_item-sort', '{{%stage_item}}', 'sort');
        $this->createIndex('idx-stage_item-status', '{{%stage_item}}', 'status');
        $this->createIndex('idx-stage_item-created_at', '{{%stage_item}}', 'created_at');
        $this->createIndex('idx-stage_item-updated_at', '{{%stage_item}}', 'updated_at');
        $this->createIndex('idx-stage_item-created_by', '{{%stage_item}}', 'created_by');
        $this->createIndex('idx-stage_item-updated_by', '{{%stage_item}}', 'updated_by');
        
        $this->addForeignKey('fk-stage_item-stage', '{{%stage_item}}', 'stage_id', '{{%stage}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%lead}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'phone' => $this->string(),
            'email' => $this->string(),
            'subject' => $this->string(),
            'body' => $this->text(),
            'created_at' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-lead-id', '{{%lead}}', 'id');
        $this->createIndex('idx-lead-name', '{{%lead}}', 'name');
        $this->createIndex('idx-lead-phone', '{{%lead}}', 'phone');
        $this->createIndex('idx-lead-email', '{{%lead}}', 'email');
        $this->createIndex('idx-lead-subject', '{{%lead}}', 'subject');
        $this->createIndex('idx-lead-created_at', '{{%lead}}', 'created_at');

        
        $this->createTable('{{%offer}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'slug' => $this->string(),
            'preview_text' => $this->text(),
            'preview_image' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-offer-id', '{{%offer}}', 'id');
        $this->createIndex('idx-offer-name', '{{%offer}}', 'name');
        $this->createIndex('idx-offer-slug', '{{%offer}}', 'slug');
        $this->createIndex('idx-offer-preview_image', '{{%offer}}', 'preview_image');
        $this->createIndex('idx-offer-sort', '{{%offer}}', 'sort');
        $this->createIndex('idx-offer-status', '{{%offer}}', 'status');
        $this->createIndex('idx-offer-created_at', '{{%offer}}', 'created_at');
        $this->createIndex('idx-offer-updated_at', '{{%offer}}', 'updated_at');
        $this->createIndex('idx-offer-created_by', '{{%offer}}', 'created_by');
        $this->createIndex('idx-offer-updated_by', '{{%offer}}', 'updated_by');
        
        $this->createTable('{{%gallery}}', [
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
        
        $this->createIndex('idx-gallery-id', '{{%gallery}}', 'id');
        $this->createIndex('idx-gallery-name', '{{%gallery}}', 'name');
        $this->createIndex('idx-gallery-sort', '{{%gallery}}', 'sort');
        $this->createIndex('idx-gallery-status', '{{%gallery}}', 'status');
        $this->createIndex('idx-gallery-created_at', '{{%gallery}}', 'created_at');
        $this->createIndex('idx-gallery-updated_at', '{{%gallery}}', 'updated_at');
        $this->createIndex('idx-gallery-created_by', '{{%gallery}}', 'created_by');
        $this->createIndex('idx-gallery-updated_by', '{{%gallery}}', 'updated_by');
        
        $this->createTable('{{%gallery_upload}}', [
            'id' => $this->primaryKey(),
            'gallery_id' => $this->integer()->notNull(),
            'file_name' => $this->string(),
            'sort' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-gallery_upload-id', '{{%gallery_upload}}', 'id');
        $this->createIndex('idx-gallery_upload-gallery_id', '{{%gallery_upload}}', 'gallery_id');
        $this->createIndex('idx-gallery_upload-file_name', '{{%gallery_upload}}', 'file_name');
        $this->createIndex('idx-gallery_upload-sort', '{{%gallery_upload}}', 'sort');
        
        $this->addForeignKey('fk-gallery_upload-gallery', '{{%gallery_upload}}', 'gallery_id', '{{%gallery}}', 'id', 'CASCADE', 'RESTRICT');
        
        $this->createTable('{{%premise}}', [
            'id' => $this->primaryKey(),
            'premise_type' => $this->string(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'layout_image' => $this->string(),
            'description' => $this->text(),
            'callback_button_name' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-premise-id', '{{%premise}}', 'id');
        $this->createIndex('idx-premise-premise_type', '{{%premise}}', 'premise_type');
        $this->createIndex('idx-premise-name', '{{%premise}}', 'name');
        $this->createIndex('idx-premise-image', '{{%premise}}', 'image');
        $this->createIndex('idx-premise-layout_image', '{{%premise}}', 'layout_image');
        $this->createIndex('idx-premise-callback_button_name', '{{%premise}}', 'callback_button_name');
        $this->createIndex('idx-premise-sort', '{{%premise}}', 'sort');
        $this->createIndex('idx-premise-status', '{{%premise}}', 'status');
        $this->createIndex('idx-premise-created_at', '{{%premise}}', 'created_at');
        $this->createIndex('idx-premise-updated_at', '{{%premise}}', 'updated_at');
        $this->createIndex('idx-premise-created_by', '{{%premise}}', 'created_by');
        $this->createIndex('idx-premise-updated_by', '{{%premise}}', 'updated_by');

        $this->createTable('{{%premise_advantage}}', [
            'id' => $this->primaryKey(),
            'premise_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'text' => $this->text(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-premise_advantage-id', '{{%premise_advantage}}', 'id');
        $this->createIndex('idx-premise_advantage-premise_id', '{{%premise_advantage}}', 'premise_id');
        $this->createIndex('idx-premise_advantage-name', '{{%premise_advantage}}', 'name');
        $this->createIndex('idx-premise_advantage-image', '{{%premise_advantage}}', 'image');
        $this->createIndex('idx-premise_advantage-sort', '{{%premise_advantage}}', 'sort');
        $this->createIndex('idx-premise_advantage-status', '{{%premise_advantage}}', 'status');
        $this->createIndex('idx-premise_advantage-created_at', '{{%premise_advantage}}', 'created_at');
        $this->createIndex('idx-premise_advantage-updated_at', '{{%premise_advantage}}', 'updated_at');
        $this->createIndex('idx-premise_advantage-created_by', '{{%premise_advantage}}', 'created_by');
        $this->createIndex('idx-premise_advantage-updated_by', '{{%premise_advantage}}', 'updated_by');
        
        $this->addForeignKey('fk-premise_advantage-premise', '{{%premise_advantage}}', 'premise_id', '{{%premise}}', 'id', 'CASCADE', 'RESTRICT');
        
        $this->createTable('{{%document_category}}', [
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

        $this->createIndex('idx-document_category-id', '{{%document_category}}', 'id');
        $this->createIndex('idx-document_category-name', '{{%document_category}}', 'name');
        $this->createIndex('idx-document_category-sort', '{{%document_category}}', 'sort');
        $this->createIndex('idx-document_category-status', '{{%document_category}}', 'status');
        $this->createIndex('idx-document_category-created_at', '{{%document_category}}', 'created_at');
        $this->createIndex('idx-document_category-updated_at', '{{%document_category}}', 'updated_at');
        $this->createIndex('idx-document_category-created_by', '{{%document_category}}', 'created_by');
        $this->createIndex('idx-document_category-updated_by', '{{%document_category}}', 'updated_by');

        $this->createTable('{{%document}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'category_id' => $this->integer(),
            'file_name' => $this->string(),
            'file_extension' => $this->string(),
            'file_size' => $this->decimal(65,2),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-document-id', '{{%document}}', 'id');
        $this->createIndex('idx-document-category_id', '{{%document}}', 'category_id');
        $this->createIndex('idx-document-name', '{{%document}}', 'name');
        $this->createIndex('idx-document-file_name', '{{%document}}', 'file_name');
        $this->createIndex('idx-document-file_extension', '{{%document}}', 'file_extension');
        $this->createIndex('idx-document-file_size', '{{%document}}', 'file_size');
        $this->createIndex('idx-document-sort', '{{%document}}', 'sort');
        $this->createIndex('idx-document-status', '{{%document}}', 'status');
        $this->createIndex('idx-document-created_at', '{{%document}}', 'created_at');
        $this->createIndex('idx-document-updated_at', '{{%document}}', 'updated_at');
        $this->createIndex('idx-document-created_by', '{{%document}}', 'created_by');
        $this->createIndex('idx-document-updated_by', '{{%document}}', 'updated_by');

        $this->addForeignKey('fk-document-document_category', '{{%document}}', 'category_id', '{{%document_category}}', 'id', 'CASCADE', 'RESTRICT');

        $this->createTable('{{%mortgage}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'text' => $this->text()->notNull(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createIndex('idx-mortgage-id', '{{%mortgage}}', 'id');
        $this->createIndex('idx-mortgage-name', '{{%mortgage}}', 'name');
        $this->createIndex('idx-mortgage-sort', '{{%mortgage}}', 'sort');
        $this->createIndex('idx-mortgage-status', '{{%mortgage}}', 'status');
        $this->createIndex('idx-mortgage-created_at', '{{%mortgage}}', 'created_at');
        $this->createIndex('idx-mortgage-updated_at', '{{%mortgage}}', 'updated_at');
        $this->createIndex('idx-mortgage-created_by', '{{%mortgage}}', 'created_by');
        $this->createIndex('idx-mortgage-updated_by', '{{%mortgage}}', 'updated_by');

        $this->createTable('{{%bank}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-bank-id', '{{%bank}}', 'id');
        $this->createIndex('idx-bank-name', '{{%bank}}', 'name');
        $this->createIndex('idx-bank-image', '{{%bank}}', 'image');
        $this->createIndex('idx-bank-sort', '{{%bank}}', 'sort');
        $this->createIndex('idx-bank-status', '{{%bank}}', 'status');
        $this->createIndex('idx-bank-created_at', '{{%bank}}', 'created_at');
        $this->createIndex('idx-bank-updated_at', '{{%bank}}', 'updated_at');
        $this->createIndex('idx-bank-created_by', '{{%bank}}', 'created_by');
        $this->createIndex('idx-bank-updated_by', '{{%bank}}', 'updated_by');
        
        $this->createTable('{{%payment}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'image' => $this->string(),
            'text' => $this->text(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-payment-id', '{{%payment}}', 'id');
        $this->createIndex('idx-payment-name', '{{%payment}}', 'name');
        $this->createIndex('idx-payment-image', '{{%payment}}', 'image');
        $this->createIndex('idx-payment-sort', '{{%payment}}', 'sort');
        $this->createIndex('idx-payment-status', '{{%payment}}', 'status');
        $this->createIndex('idx-payment-created_at', '{{%payment}}', 'created_at');
        $this->createIndex('idx-payment-updated_at', '{{%payment}}', 'updated_at');
        $this->createIndex('idx-payment-created_by', '{{%payment}}', 'created_by');
        $this->createIndex('idx-payment-updated_by', '{{%payment}}', 'updated_by');
    }

    public function safeDown()
    {
        $this->dropTable('{{%payment}}');
        $this->dropTable('{{%bank}}');
        $this->dropTable('{{%mortgage}}');
        $this->dropTable('{{%document}}');
        $this->dropTable('{{%document_category}}');
        $this->dropTable('{{%premise_advantage}}');
        $this->dropTable('{{%premise}}');
        $this->dropTable('{{%gallery_upload}}');
        $this->dropTable('{{%gallery}}');
        $this->dropTable('{{%offer}}');
        $this->dropTable('{{%lead}}');
        $this->dropTable('{{%stage_item}}');  
        $this->dropTable('{{%stage}}');
    }
}
