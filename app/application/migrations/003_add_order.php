<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_order extends CI_Migration
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
            'invoice' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'address' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'phone' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'status' => array(
                'type' => 'ENUM',
                'constraint' => ['waiting', 'delivery', 'cancel', 'paid'],
                'default' => 'waiting'
            )
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('invoice', TRUE);
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (user_id) REFERENCES user(id)');
        $this->dbforge->create_table('order');
    }

    public function down()
    {
        $this->dbforge->drop_table('order');
    }

}
