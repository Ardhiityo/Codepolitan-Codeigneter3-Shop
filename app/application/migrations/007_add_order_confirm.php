<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order_confirm extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'order_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'account_name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'account_number' => array(
                'type' => 'INT',
            ),
            'nominal' => array(
                'type' => 'INT',
            ),
            'note' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'image_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (order_id) REFERENCES `order`(id)');
        $this->dbforge->create_table('order_confirm');
    }

    public function down()
    {
        $this->dbforge->drop_table('order_confirm');
    }
}
