<?php
namespace App\infra\persistence\dao;
use App\infra\persistence\dao\BaseDAO;
use PDO;

/**
 * eateriesテーブルのCRUD操作を実行するクラス
 */
class EateryDAO extends BaseDAO {

	/**
	 * クラス定数
	 */
	// SQL文字列定数
	private const SQL_FIND_ALL = "SELECT * FROM eateries ORDER BY id";

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
	 * eateriesテーブルの全件検索を実行する
	 */
	public function findAll():array {
		$stmt = $this->pdo->query(self::SQL_FIND_ALL);
		$eateries = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $eateries;
	}
}