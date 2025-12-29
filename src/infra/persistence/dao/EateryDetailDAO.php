<?php
namespace App\infra\persistence\dao;

use App\infra\persistence\dao\BaseDAO;
use App\infra\persistence\dao\DAOException;
use PDO;

class EateryDetailDAO extends BaseDAO {
	
	/**
	 * クラス定数
	 */
	private const SQL_FIND_EATERY_JOIN_AREA = <<<_EOD_
		SELECT
				eateries.id          AS id
			, eateries.area        AS area_id
			, areas.name           AS area_name
			, eateries.name        AS name
			, eateries.address     AS address
			, eateries.description AS description
			, eateries.image       AS image
		FROM eateries
		JOIN areas ON eateries.area = areas.id 
		WHERE eateries.id = :id
		ORDER BY eateries.id;
	_EOD_;
	
	/**
	 * フィールド
	 */
	private PDO $pdo;

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		$this->pdo = self::connect();
	}

	/**
	 * eateriesテーブルとareasテーブルのJOINからレコードを取得する
	 * @param  $id eateries.id
	 * @return EateryDetailのインスタンス
	 */
	public function findById($id) {
		try {
			// SQL実行オブジェクトを取得
			$pstmt = $this->pdo->prepare(self::SQL_FIND_EATERY_JOIN_AREA);
			// パラメータバインディング
			$pstmt->bindValue(":id", $id, PDO::PARAM_INT);
			// SQLの実行
			$pstmt->execute();
			// 実行結果をリストに変換
			$row = $pstmt->fetch(PDO::FETCH_ASSOC);
			// リストを返却
			return $row ?: null;
		} catch (\PDOException $e) {
			throw new DAOException("レコードの取得に失敗しました\n" . $e->getMessage() , $e);
		}
	}



}