<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PDO;
use PDOException;

class CreateDB extends Command
{
    protected $signature = 'db:create';
    protected $description = 'Create database from .env';

    public function handle()
    {
        $databaseName = config('database.connections.mysql.database');
        $host = config('database.connections.mysql.host');
        $port = config('database.connections.mysql.port');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');

        try {
            $connection = new PDO("mysql:host=$host;port=$port", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql = "CREATE DATABASE IF NOT EXISTS `$databaseName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
            $connection->exec($sql);

            $this->info("Database '$databaseName' created successfully.");
        } catch (PDOException $e) {
            $this->error("Error creating database: " . $e->getMessage());
        }
    }
}
