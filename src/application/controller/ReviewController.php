<?php
namespace App\application\controller;

use App\application\controller\BaseController;
use App\application\form\dto\ReviewPostDTO;
use App\application\entity\Review;
use App\application\service\ReviewService;
use App\application\service\EateryDetailService;
use App\application\service\ReviewDetailService;
use App\application\config\ReviewConfigure;

use App\infra\config\Configures;
use App\infra\http\Request;
use App\view\View;

/**
 * レビュに関する処理を制御するコントローラ
 */
class ReviewController extends BaseController {

	public function execute(Request $request) {
			// リクエストパラメータを取得
			$reviewPostDto = new ReviewPostDTO(
				eateryId: $request->body["eateryId"],
				handleId: $request->body["handleId"],
				handleName: $request->body["handleName"],
				title: $request->body["title"],
				comment: $request->body["comment"],
				rating: $request->body["rating"]
			);

			// レビュDTOをentityに変換
			$review = new Review(
				id: null,
				eateryId: $reviewPostDto->getEateryId(),
				reviewer: (int) $reviewPostDto->getHandleId(),
				title: $reviewPostDto->getTitle(),
				comment: $reviewPostDto->getComment(),
				rating: (int) $reviewPostDto->getRating()
			);
			
			// レビュを登録
			$reviewService = new ReviewService();
			$reviewService->save($review);

			// セッションに投稿完了メッセージを登録
			$_SESSION["flash_message"] = "レビューを投稿しました。";

			// リダイレクト先URLを生成して送信
			$redirectURL = Configures::BASE_PATH."/detail?id=".$review->getEateryId();
			header("Location: {$redirectURL}");
			exit;
			
	}

	/**
	 * レビュ確認画面を表示する
	 */
	public function confirm(Request $request) {
		$review	= new ReviewPostDTO("7", "2", "totsuka", "時代遅れのおれ", "1980年の、馴染みはないがジョシュ・ブローリンのお父さん主演、ありがちなstoryだが誘拐された娘の奪還映画が掛かっているようで、ちょうど正午の映画の切符をとって新宿にやって来た", "5");
		// レビュ確認画面をレンダリング
		$title = "レビュの確認";
		$this->contents[] = (new View("review/confirm", [
			"title" => $title,
			"review" => $review,
			"base" => Configures::BASE_PATH
		]))->render();
		// レイアウトに組み込んで出力
		$this->renderLayout($title);
	}
}