<?php
namespace App\infra\persistence\dao;
use PDO;
use App\infra\persistence\dao\BaseDAO;

/**
 * areasテーブルのCRUD操作を実行するクラス
 */
class AreaDAO extends BaseDAO {

	/**
	 * クラス定数
	 */
	// SQL文字列定数
	private const SQL_FIND_ALL = "SELECT id, name FROM areas ORDER BY id";

	/**
	 * フィールド
	 */
	private PDO $pdo; // データベース接続オブジェクト

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		$this->pdo = self::connect();
	}

	/**
	 * areasテーブルの全件検索を実行する
	 */
	public function findAll():array {
		$stmt = $this->pdo->query(self::SQL_FIND_ALL);
		$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $areas;
	}

}