<?php
/*
require_once __DIR__ . '/../sample/src/Calculator.php';
require_once __DIR__ . '/../sample/src/MonologExample.php';
*/
<?php

declare(strict_types=1);

// プロジェクトルート
$root = dirname(__DIR__);

// Composer autoload
require_once $root . '/vendor/autoload.php';

// .env 読み込み（無くても落とさない）
Dotenv\Dotenv::createImmutable($root)->safeLoad();

// 必須環境変数チェック
$required = ['DB_NAME', 'DB_USER', 'DB_PASS'];

foreach ($required as $key) {
	if (getenv($key) === 'change_me') {
		throw new RuntimeException(
			"$key is still 'change_me'. Please check create_db.sql and update .env"
		);
	}
}
