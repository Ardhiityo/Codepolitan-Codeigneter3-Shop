<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user extends CI_Migration
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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'is_active' => array(
                'type' => 'BOOLEAN',
                'default' => TRUE
            ),
            'role' => array(
                'type' => 'ENUM',
                'constraint' => ['admin', 'member'],
                'default' => 'member'
            ),
            'image_url' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('email', TRUE);
        $this->dbforge->create_table('user');
    }

    public function down()
    {
        $this->dbforge->drop_table('user_tb');
    }

}