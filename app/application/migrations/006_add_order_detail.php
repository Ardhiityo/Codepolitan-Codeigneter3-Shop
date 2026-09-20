<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order_detail extends CI_Migration
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
            'product_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'quantity' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
            ),
            'subtotal' => array(
                'type' => 'INT',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (order_id) REFERENCES `order`(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES product(id)');
        $this->dbforge->create_table('order_detail');
    }

    public function down()
    {
        $this->dbforge->drop_table('order_detail');
    }
}
