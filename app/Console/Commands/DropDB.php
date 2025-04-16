<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class DropDB extends Command
{
    protected $signature = 'db:drop';
    protected $description = 'Drop database from .env';

    public function handle()
    {
        $databaseName = config('database.connections.pgsql.database');
        $host = config('database.connections.pgsql.host');
        $port = config('database.connections.pgsql.port');
        $username = config('database.connections.pgsql.username');
        $password = config('database.connections.pgsql.password');

        try {
            $connection = new PDO("pgsql:host=$host;port=$port;dbname=postgres", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $connection->prepare("SELECT 1 FROM pg_catalog.pg_database WHERE datname = :dbname");
            $stmt->execute(['dbname' => $databaseName]);

            if ($stmt->rowCount() > 0) {
                $connection->exec("SELECT pg_terminate_backend(pid) FROM pg_stat_activity WHERE datname = '$databaseName'");
                $connection->exec("DROP DATABASE \"$databaseName\"");
                $this->info("Database $databaseName dropped successfully");
            } else {
                $this->error("Database $databaseName does not exist");
            }
        } catch (PDOException $e) {
            $this->error("Database dropping error: " . $e->getMessage());
        }
    }
}
