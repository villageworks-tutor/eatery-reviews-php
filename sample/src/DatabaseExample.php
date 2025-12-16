<?php
require_once __DIR__ . '/Database.php';

// データベース接続
$db = new Database();
$pdo = $db->getConnection();

// クエリ実行例
$stmt = $pdo->query("SELECT NOW()");
echo "現在時刻: " . $stmt->fetchColumn() . PHP_EOL;
