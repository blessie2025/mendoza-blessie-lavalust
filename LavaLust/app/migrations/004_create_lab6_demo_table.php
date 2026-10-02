<?php

class Create_lab6_demo_table {

    private $_lava;
    protected $dbforge;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->dbforge();
    }

    public function up()
    {
        // Write your "UP" migration here
        $this->_lava->dbforge->add_field([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => TRUE,
                'auto_increment' => TRUE
            ]
        ]);

        $this->_lava->dbforge->add_key('id', TRUE);
        $this->_lava->dbforge->create_table('lab6_demo_table');
    }

    public function down()
    {
        // Write your "DOWN" migration here
        $this->_lava->dbforge->drop_table('lab6_demo_table');
    }
}