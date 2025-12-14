<?php
require_once __DIR__."/../../vendor/autoload.php";
require_once __DIR__."/../src/MonologExample.php";

use PHPUnit\Framework\TestCase;


class MonologExampleTest extends TestCase
{
    private string $logFile;

    protected function setUp(): void
    {
        $this->logFile = __DIR__ . '/../src/sample.log';
        // 既存ログがあれば削除
        if (file_exists($this->logFile)) {
            unlink($this->logFile);
        }
    }

    public function testRunCreatesLogFile(): void
    {
        // サンプル実行
        MonologExample::run();

        // ログファイルが作成されていることを確認
        $this->assertFileExists($this->logFile);

        // ログ内容に "Hello Monolog!" が含まれているか確認
        $content = file_get_contents($this->logFile);
        $this->assertStringContainsString('Hello Monolog!', $content);
    }

    protected function tearDown(): void
    {
        // テスト後にログファイルを削除
        if (file_exists($this->logFile)) {
            unlink($this->logFile);
        }
    }
}
