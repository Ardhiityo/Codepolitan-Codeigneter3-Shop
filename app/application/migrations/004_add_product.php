<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_product extends CI_Migration
{
    public function __construct()
    {
        // 
    }

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'category_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'desc' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'price' => array(
                'type' => 'INT',
            ),
            'is_available' => array(
                'type' => 'BOOLEAN',
                'default' => TRUE,
            ),
            'image_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('slug', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (category_id) REFERENCES category(id)');
        $this->dbforge->create_table('product');
    }

    public function down()
    {
        $this->dbforge->drop_table('product');
    }
}
