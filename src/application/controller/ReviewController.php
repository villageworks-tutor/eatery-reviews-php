<?php
namespace App\application\controller;

use App\application\controller\BaseController;
use App\application\form\dto\ReviewPostDTO;
use App\application\entity\Review;
use App\application\service\ReviewService;
use App\application\service\EateryDetailService;
use App\application\service\ReviewDetailService;
use App\application\config\ReviewConfigure;
use App\application\service\Validator;

use App\infra\config\Configures;
use App\infra\http\Request;
use App\view\View;

/**
 * レビュに関する処理を制御するコントローラ
 */
class ReviewController extends BaseController {

	public function edit(Request $request) {
		// セッションからレビュDTOを取得
		$reviewDto = $_SESSION["reviewDto"];
		// リダイレクト先URLを生成して送信
		$redirectURL = Configures::BASE_PATH."/detail?id=".$reviewDto->getEateryId();
		header("Location: {$redirectURL}");
		exit;
	}

	/**
	 * レビュを投稿する
	 * @param $request HTTPリクエストオブジェクト
	 */
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
	 * @param $request HTTPしクエストオブジェクト
	 */
	public function confirm(Request $request) {
		// リクエストパラメータを取得
		$reviewDto = new ReviewPostDTO(
			eateryId: $request->body["eateryId"],
			handleId: $request->body["handleId"],
			handleName: $request->body["handleName"],
			title: $request->body["title"] ?? "",
			comment: $request->body["review"],
			rating: $request->body["rating"]
		);

		$subject = trim($request->body["title"] ?? "");
		if ($subject === "") {
				$subject = "無題";
		}
		$reviewDto->setTitle($subject);

		// セッションに登録
		$_SESSION["reviewDto"] = $reviewDto;

		// 入力値チェック
		if (!Validator::isRequired($reviewDto->getComment())) {
			$_SESSION["error"] = "口コミは必須です。";
			$redirectURL = Configures::BASE_PATH . "/detail?id=" . $reviewDto->getEateryId();
			header("Location: {$redirectURL}");
			exit;
		}

		// レビュ確認画面をレンダリング
		$title = "レビュの確認";
		$selectedRating = (int) $reviewDto->getRating();
		$this->contents[] = (new View("review/confirm", [
			"title" => $title,
			"review" => $reviewDto ?? new $reviewDto(),
			"selectedRating" => $selectedRating,
			"base" => Configures::BASE_PATH
		]))->render();
		// レイアウトに組み込んで出力
		$this->renderLayout($title);
	}
}