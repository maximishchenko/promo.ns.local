<?php

use yii\db\Migration;

class m231003_194230_create_seo_module_tables extends Migration
{
    public function safeUp()
    {        
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%redirect}}', [
            'id' => $this->primaryKey(),
            'source_url' => $this->string()->notNull(),
            'destination_url' => $this->string()->notNull(),
            'redirect_code' => $this->integer()->notNull(),
            'comment' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-redirect-id', '{{%redirect}}', 'id');
        $this->createIndex('idx-redirect-source_url', '{{%redirect}}', 'source_url');
        $this->createIndex('idx-redirect-destination_url', '{{%redirect}}', 'destination_url');
        $this->createIndex('idx-redirect-redirect_code', '{{%redirect}}', 'redirect_code');
        $this->createIndex('idx-redirect-sort', '{{%redirect}}', 'sort');
        $this->createIndex('idx-redirect-status', '{{%redirect}}', 'status');
        $this->createIndex('idx-redirect-created_at', '{{%redirect}}', 'created_at');
        $this->createIndex('idx-redirect-updated_at', '{{%redirect}}', 'updated_at');
        $this->createIndex('idx-redirect-created_by', '{{%redirect}}', 'created_by');
        $this->createIndex('idx-redirect-updated_by', '{{%redirect}}', 'updated_by');

        $this->createTable('{{%script}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->unique(),
            'position' => $this->string(50),
            'code' => $this->text(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        
        $this->createIndex('idx-script-id', '{{%script}}', 'id');
        $this->createIndex('idx-script-name', '{{%script}}', 'name');
        $this->createIndex('idx-script-position', '{{%script}}', 'position');
        $this->createIndex('idx-script-sort', '{{%script}}', 'sort');
        $this->createIndex('idx-script-status', '{{%script}}', 'status');
        $this->createIndex('idx-script-created_at', '{{%script}}', 'created_at');
        $this->createIndex('idx-script-updated_at', '{{%script}}', 'updated_at');
        $this->createIndex('idx-script-created_by', '{{%script}}', 'created_by');
        $this->createIndex('idx-script-updated_by', '{{%script}}', 'updated_by');

        $this->createTable('{{%meta_tag}}', [
            'id' => $this->primaryKey(),
            'url' => $this->string()->unique(),
            'h1_text' => $this->string(), 
            'description_text' => $this->text(), 
            'meta_title' => $this->string(),
            'meta_keywords' => $this->string(),
            'meta_description' => $this->text(),
            'og_title' => $this->string(),
            'og_description' => $this->text(),
            'og_image' => $this->string(),
            'og_url' => $this->string(),
            'og_sitename' => $this->string(),
            'og_type' => $this->string(),
            'sort' => $this->integer(),
            'status' => $this->smallInteger(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);
        
        $this->createIndex('idx-meta_tag-id', '{{%meta_tag}}', 'id');
        $this->createIndex('idx-meta_tag-url', '{{%meta_tag}}', 'url');
        $this->createIndex('idx-meta_tag-h1_text', '{{%meta_tag}}', 'h1_text');
        $this->createIndex('idx-meta_tag-meta_title', '{{%meta_tag}}', 'meta_title');
        $this->createIndex('idx-meta_tag-meta_keywords', '{{%meta_tag}}', 'meta_keywords');
        $this->createIndex('idx-meta_tag-og_title', '{{%meta_tag}}', 'og_title');
        $this->createIndex('idx-meta_tag-og_image', '{{%meta_tag}}', 'og_image');
        $this->createIndex('idx-meta_tag-og_url', '{{%meta_tag}}', 'og_url');
        $this->createIndex('idx-meta_tag-og_sitename', '{{%meta_tag}}', 'og_sitename');
        $this->createIndex('idx-meta_tag-og_type', '{{%meta_tag}}', 'og_type');
        $this->createIndex('idx-meta_tag-sort', '{{%meta_tag}}', 'sort');
        $this->createIndex('idx-meta_tag-status', '{{%meta_tag}}', 'status');
        $this->createIndex('idx-meta_tag-created_at', '{{%meta_tag}}', 'created_at');
        $this->createIndex('idx-meta_tag-updated_at', '{{%meta_tag}}', 'updated_at');
        $this->createIndex('idx-meta_tag-created_by', '{{%meta_tag}}', 'created_by');
        $this->createIndex('idx-meta_tag-updated_by', '{{%meta_tag}}', 'updated_by');
    }

    public function safeDown()
    {   
        $this->dropTable('{{%redirect}}');     
        $this->dropTable('{{%script}}');        
        $this->dropTable('{{%meta_tag}}');
    }
}
