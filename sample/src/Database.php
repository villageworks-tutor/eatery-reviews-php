<?php
require_once __DIR__."/../../vendor/autoload.php";
use Dotenv\Dotenv;

class Database
{
    private PDO $connection;

    public function __construct(string $envPath = __DIR__ . '/../../')
    {
        $dotenv = Dotenv::createImmutable($envPath);
        $dotenv->load();

        $this->connect();
    }

    private function connect(): void
    {
        $dsn = sprintf(
            '%s:host=%s;port=%s;dbname=%s;charset=utf8',
            $_ENV['DB_CONNECTION'],
            $_ENV['DB_HOST'],
            $_ENV['DB_PORT'],
            $_ENV['DB_DATABASE']
        );

        try {
            $this->connection = new PDO($dsn, $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
            if ($_ENV['APP_DEBUG'] === 'true') {
                echo "DB接続成功" . PHP_EOL;
            }
        } catch (PDOException $e) {
            echo "DB接続失敗: " . $e->getMessage() . PHP_EOL;
            exit(1);
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
