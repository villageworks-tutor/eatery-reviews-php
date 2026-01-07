<?php
namespace App\infra\persistence\dao;

use App\infra\persistence\dao\BaseDAO;
use App\infra\persistence\dao\DAOException;
use PDO;

class ReviewDetailDAO extends BaseDAO {

	/**
	 * クラス定数
	 */
	private const SQL_FIND_REVIEW_JOIN_MEMBER = <<<_EOD_
		SELECT
			reviews.id
			, reviews.eatery_id AS eatery_id
			, reviews.reviewer  AS reviewer_id
			, members.handle    AS handle
			, reviews.title     AS title
			, reviews.comment   AS comment
			, reviews.rating    AS rating
			, reviews.image     AS image
			, reviews.posted_at AS posted_at
		FROM reviews
		JOIN members ON reviews.reviewer = members.id
		WHERE eatery_id = :eateryId
		ORDER BY posted_at DESC;
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
	 * reviewsテーブルとmembersテーブルのJOINからレコードを取得する
	 * @param  $eateryId レストランID
	 * @return ReviewDetailインスタンスのリスト
	 */
	public function findByEateryId(int $eateryId):array {
		try {
			// SQL実行オブジェクトを取得
			$pstmt = $this->pdo->prepare(self::SQL_FIND_REVIEW_JOIN_MEMBER);
			// パラメータバインディング
			$pstmt->bindValue(":eateryId", $eateryId, PDO::PARAM_INT);
			// SQLの実行
			$pstmt->execute();
			// 実行結果をリストに変換
			$list = $pstmt->fetchAll(PDO::FETCH_ASSOC);
			// リストを返却
			return $list;
		} catch (\PDOException $e) {
			throw new DAOException("レコードの取得に失敗しました\n" . $e->getMessage() , $e);
		}
	}

}