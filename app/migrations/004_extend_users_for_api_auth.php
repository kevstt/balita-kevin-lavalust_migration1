<?php

class Extend_users_for_api_auth
{
    private $_lava;

    public function __construct()
    {
        $this->_lava = lava_instance();
        $this->_lava->call->database();
    }

    public function up()
    {
        $columns = $this->_lava->db
            ->raw('SHOW COLUMNS FROM users')
            ->fetchAll(PDO::FETCH_COLUMN, 0);

        if (!in_array('password', $columns, true)) {
            $this->_lava->db->raw('ALTER TABLE users ADD COLUMN password VARCHAR(255) NULL DEFAULT NULL');
        }

        if (!in_array('role', $columns, true)) {
            $this->_lava->db->raw("ALTER TABLE users ADD COLUMN role VARCHAR(32) NOT NULL DEFAULT 'user'");
        }

        if (!in_array('is_active', $columns, true)) {
            $this->_lava->db->raw('ALTER TABLE users ADD COLUMN is_active TINYINT(1) UNSIGNED NOT NULL DEFAULT 1');
        }
    }

    public function down()
    {
    }
}