<?php

require __DIR__.'/../vendor/autoload.php';

if (($_ENV['DB_CONNECTION'] ?? 'sqlite') === 'sqlite') {
    $database = $_ENV['DB_DATABASE'] ?? null;

    if (($database ?? '') !== '') {
        $path = __DIR__.'/../'.$database;
        $directory = dirname($path);

        // Recreate the test SQLite file if it was removed locally.
        if (! is_dir($directory)) {
            mkdir($directory, 0777, true);
        }

        if (! file_exists($path)) {
            touch($path);
        }

        // Seed the expected xeeds table so tests can run from a clean checkout.
        $pdo = new PDO('sqlite:'.$path);
        $tableExists = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='xeeds';")->fetchColumn();

        if ($tableExists === false) {
            $sql = file_get_contents(__DIR__.'/../database/xeeds.sqlite.sql');
            $pdo->exec($sql);
        }
    }
}
