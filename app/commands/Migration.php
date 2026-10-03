<?php

class Migration
{
    public static $command = 'migration';
    public static $description = 'Run database migrations';
    public static $arguments = [
        '[action]' => 'run, create-migration, rollback, rollback-all, refresh, status',
        '[name]' => 'Migration name for create-migration',
    ];

    private static $route_map = [
        'run' => 'migrate',
        'rollback' => 'rollback',
        'rollback-all' => 'rollback-all',
        'refresh' => 'refresh',
        'status' => 'status',
    ];

    public function handle($action = null, array $flags = [], $name = null)
    {
        $action = $action ?: 'run';

        if ($action === 'create-migration') {
            if (!$name) {
                fwrite(STDERR, "Migration name is required. Example: php lava migration create-migration create_products_table\n");
                exit(1);
            }
            $route = '__migration/create-migration/' . $name;
        } elseif (isset(self::$route_map[$action])) {
            $route = '__migration/' . self::$route_map[$action];
        } else {
            fwrite(STDERR, 'Unknown migration action. Available: run, create-migration, rollback, rollback-all, refresh, status' . PHP_EOL);
            exit(1);
        }

        $index = PUBLIC_DIR . 'index.php';
        if (!file_exists($index)) {
            fwrite(STDERR, "public/index.php not found.\n");
            exit(1);
        }

        $command = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg($index) . ' ' . escapeshellarg($route);
        passthru($command, $exit_code);
        exit($exit_code);
    }
}