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
	private const SQL_FIND_BY_AREA = "SELECT * FROM eateries WHERE area = :area ORDER BY id";

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
	 * @return 結果リスト
	 */
	public function findAll():array {
		// SQL実行オブジェクトを取得
		$stmt = $this->pdo->query(self::SQL_FIND_ALL);
		// SQLの実行と結果をリストに変換
		$eateries = $stmt->fetchAll(PDO::FETCH_ASSOC);
		// リストを返却
		return $eateries;
	}

	/**
	 * eateriesテーブルの地域別検索を実行する
	 * @return 結果リスト
	 */
	public function findByArea(int $area):array {
		// SQL実行オブジェクトを取得
		$pstmt = $this->pdo->prepare(self::SQL_FIND_BY_AREA);
		// パラメータバインディング
		$pstmt->bindValue(":area", $area, PDO::PARAM_INT);
		// SQLの実行
		$pstmt->execute();
		// 実行結果をリストに変換
		$eateries = $pstmt->fetchAll(PDO::FETCH_ASSOC);
		// リストを返却
		return $eateries;
	}
}