<?php
namespace App\application\service;

use App\application\service\BaseService;
use App\application\entity\Review;
use App\infra\persistence\dao\ReviewDAO;

class ReviewService extends BaseService {
	
	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct(ReviewDAO::class);
	}

	/**
	 * レビュを保存する
	 * @param $review 保存するレビュインスタンス
	 */
	public function save(Review $review) {
		if ($review->getId() === null) {
			// 新規登録の場合
			$this->dao->insert($review);
		}
	}

}