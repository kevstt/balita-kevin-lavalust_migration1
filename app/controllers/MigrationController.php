<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class MigrationController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!defined('IS_CLI') || !IS_CLI) {
            http_response_code(404);
            exit;
        }

        $this->call->library('migration');
    }

    public function create_migration($name)
    {
        if (!preg_match('/^[a-zA-Z0-9_-]+$/', $name)) {
            fwrite(STDERR, "Invalid migration name. Use letters, numbers, underscores, or hyphens.\n");
            exit(1);
        }

        $this->migration->create_migration($name);
    }

    public function migrate()
    {
        $this->migration->migrate();
    }

    public function rollback()
    {
        $this->migration->rollback();
    }

    public function rollback_all()
    {
        $this->migration->rollback_all();
    }

    public function refresh()
    {
        $this->migration->refresh();
    }

    public function status()
    {
        $this->migration->status();
    }
}