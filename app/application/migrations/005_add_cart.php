<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_cart extends CI_Migration
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
            'user_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'product_id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
            ),
            'quantity' => array(
                'type' => 'INT',
            ),
            'subtotal' => array(
                'type' => 'INT',
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (product_id) REFERENCES product(id)');
        $this->dbforge->create_table('cart');
    }

    public function down()
    {
        $this->dbforge->drop_table('cart');
    }
}
