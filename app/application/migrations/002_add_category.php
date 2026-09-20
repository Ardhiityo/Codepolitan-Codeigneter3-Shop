<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_category extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'BIGINT',
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
        ));

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('slug', TRUE);
        $this->dbforge->create_table('category');
    }

    public function down()
    {
        $this->dbforge->drop_table('category');
    }
}
