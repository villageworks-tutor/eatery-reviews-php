<?php
namespace App\application\service;

use App\application\entity\ReviewDetail;
use App\application\service\BaseService;
use App\application\service\ServiceException;
use App\infra\persistence\dao\DAOException;
use App\infra\persistence\dao\ReviewDetailDAO;
use App\application\form\dto\ReviewDetailDTO;

/**
 * 表示レビュに関する処理を実行するサービス
 */
class ReviewDetailService extends BaseService {

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct(ReviewDetailDAO::class);
	}

	/**
	 * レストランごとのすべてのレビュを取得する
	 * @param  $eateryId 取得対象のレストランID
	 * @return レストランごとのレビュリスト
	 */
	public function getReviewsByEateryId(int $eateryId):array {
		try {
			$result = $this->dao->findByEateryId($eateryId);
			$list = $this->convertResultToList($result);
			$reviewList = $this->convertListToDto($list);
			return $reviewList;
		} catch (DAOException $e) {
			throw new ServiceException("レビュリスト作成に失敗しました\n" . $e->getMessage() , $e);
		}
	}

	/**
	 * 結果セットをentityのリストに変換する
	 * @param  $result 結果セット
	 * @return entityのリスト
	 */
	private function convertResultToList(array $result):array {
		$reviewList = [];
		foreach ($result as $review) {
			$reviewList[] = new ReviewDetail(
				id: $review["id"],
				handle: $review["handle"],
				title: $review["title"],
				comment: $review["comment"],
				rating: $review["rating"],
				image: $review["image"],
				postedAt: $review["posted_at"]
			);
		}
		return $reviewList;
	}

	/**
	 * entityリストからDTOリストに変換する
	 * @param  $entity ReviewDetailインスタンス
	 * @return ReviewDetailDTOインスタンスのリスト
	 */
	private function convertListToDto(array $list):array {
		$reviewList = [];
		foreach ($list as $row) {
			$reviewList[] = new ReviewDetailDTO(
				id: $row->getId(),
				handle: $row->getHandle(),
				title: $row->getTitle(),
				comment: $row->getComment(),
				rating: $this->convertPointsToStars($row->getRating()),
				image: $row->getImage(),
				postedAt: $row->getPostedAt()
			);
		}
		return $reviewList;
	}

	/**
	 * 評価ポイントを星印の文字列に変換する
	 * @param $rating 評価ポイント
	 * @return 評価ポイントの数「★」の文字列
	 */
	private function convertPointsToStars(int $rating):string {
		$maxPoint = 5; // TODO: 評価ポイント表示の繰り返し回数と連動させる？
		$stars = "";
		for ($i = 0; $i < $maxPoint; $i++) {
			if ($i < $rating) {
				$stars .= "★";
			} else {
				$stars .= "☆";
			}
		}
		return $stars;
	}

}

