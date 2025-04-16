<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;

class CreateDB extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create database from .env';

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

            if ($stmt->rowCount() == 0) {
                $connection->exec("CREATE DATABASE \"$databaseName\"");
                
                $dbConnection = new PDO("pgsql:host=$host;port=$port;dbname=$databaseName", $username, $password);
                $dbConnection->exec("CREATE EXTENSION IF NOT EXISTS postgis");
                
                $this->info("Database created successfully");
            } else {
                $this->info("Database already exists");
            }
        } catch (PDOException $e) {
            $this->error("Database creation error: " . $e->getMessage());
        }
    }
}
