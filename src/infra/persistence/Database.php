<?php
namespace App\infra\persistence;
use Dotenv\Dotenv;
use PDO;

/**
 * データベースにアクセスするクラス
 */
class Database {

	/**
	 * クラス変数：.envファイルのロード状態
	 */
	private static bool $isLoadedEnv = false;

	/**
	 * データベースに接続する
	 * @return PDO データベース接続オブジェクト
	 */
	public static function connect():PDO {
		// .envファイルの読み込み
		self::loadEnv();
		// DSNを生成
		$dsn = sprintf(
				'%s:host=%s;port=%s;dbname=%s;charset=utf8mb4',
				$_ENV['DB_CONNECTION'],
				$_ENV['DB_HOST'],
				$_ENV['DB_PORT'],
				$_ENV['DB_DATABASE']
		);
		// DBユーザとパスワードを取得
		$user = $_ENV["DB_USERNAME"];
		$password = $_ENV["DB_PASSWORD"];
		// データベース接続オブジェクトを生成
		$pdo = new PDO($dsn, $user, $password, [
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);

		return $pdo;
	}

	/**
	 * .envファイルを読み込む
	 */
	private static function loadEnv():void {
		if (!self::$isLoadedEnv) {
			// .envファイルの読込み
			$dotenv = Dotenv::createImmutable(__DIR__."/../../../");
			$dotenv->load();
			self::$isLoadedEnv = true;
		}
	}

}