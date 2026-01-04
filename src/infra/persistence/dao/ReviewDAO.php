<?php
namespace App\infra\persistence\dao;

use App\infra\persistence\dao\BaseDAO;
use App\infra\persistence\dao\DAOException;
use PDO;
use App\application\entity\Review;

class ReviewDAO extends BaseDAO {

	/**
	 * クラス定数
	 */
	private const SQL_INSERT_INTO_REVIEW = <<<_EOD_
		INSERT INTO reviews (eatery_id, reviewer, title, comment, rating, image, posted_at, updated_at)
		             VALUES (:eatery_id, :reviewer, :title, :comment, :rating, :image, :posted_at, :updated_at);
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
	 * reviewsテーブルにReviewエンティティを挿入する
	 * @param $review 挿入するReviewエンティティ
	 */
	public function insert(Review $review):void {
		try {
			// SSQL実行オブジェクトを取得
			$pstmt = $this->pdo->prepare(self::SQL_INSERT_INTO_REVIEW);
			// パラメータバインディング
			$now = new \DateTime();
			$now = $now->format("Y-m-d H:i:s");
			$pstmt->bindValue(":eatery_id", $review->getEateryId(), PDO::PARAM_INT);
			$pstmt->bindValue(":reviewer", $review->getReviewer(), PDO::PARAM_STR);
			$pstmt->bindValue(":title", $review->getTitle(), PDO::PARAM_STR);
			$pstmt->bindValue(":comment", $review->getComment(), PDO::PARAM_STR);
			$pstmt->bindValue(":rating", $review->getRating(), PDO::PARAM_INT);
			$pstmt->bindValue(":image", "", PDO::PARAM_STR);
			$pstmt->bindValue(":posted_at", $now, PDO::PARAM_STR);
			$pstmt->bindValue(":updated_at", $now, PDO::PARAM_STR);
			// SQLの実行
			$pstmt->execute();
		} catch (\PDOException $e) {
			throw new DAOException("レコードの追加に失敗しました\n" . $e->getMessage() , $e);
		}
	}

}