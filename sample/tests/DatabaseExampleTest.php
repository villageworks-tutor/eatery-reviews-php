<?php
require_once __DIR__."/../src/Database.php";
use PHPUnit\Framework\TestCase;

class DatabaseExampleTest extends TestCase
{
    private Database $db;

    protected function setUp(): void
    {
        $this->db = new Database(__DIR__ . '/../../'); // プロジェクトルートの .env を読み込む
    }

    public function testConnection(): void
    {
        $pdo = $this->db->getConnection();
        $this->assertInstanceOf(\PDO::class, $pdo, 'PDO インスタンスが返ること');
    }

    public function testQueryNow(): void
    {
        $pdo = $this->db->getConnection();
        $stmt = $pdo->query("SELECT NOW()");
        $result = $stmt->fetchColumn();
        $this->assertNotFalse($result, 'SELECT NOW() が失敗しないこと');
        $this->assertMatchesRegularExpression('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}/', $result, '結果が日時形式であること');
    }
}
