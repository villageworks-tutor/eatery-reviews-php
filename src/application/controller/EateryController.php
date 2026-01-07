<?php
namespace App\application\controller;

use PDO;
use App\infra\config\Configures;
use App\infra\http\Request;
use App\view\View;

use App\application\controller\BaseController;
use App\application\service\AreaService;
use App\application\service\EateryService;
use App\application\service\EateryDetailService;
use App\application\service\ReviewDetailService;
use App\application\service\ServiceException;
use App\application\form\dto\ReviewPostDTO;
use App\application\config\ReviewConfigure;
use App\application\utils\StringUtils;

/**
 * レストランに関する処理を制御するコントローラ
 */
class EateryController extends BaseController	{

	/**
	 * レストラン一覧画面を表示する（初期表示）
	 */
	public function index() {
		try {
			
			// 地域別検索要セレクトボックスの元データを取得
			$areaService = new AreaService();
			$areas = $areaService->getAreaList();

			// レストラン一覧用リストを取得
			$eateryService = new EateryService();
			$eateries = $eateryService->getAllEatery();

			// レストラン一覧画面をレンダリング
			$title = "レストラン一覧";
			$this->contents[] = (new View("eateries/list", [
				"title" => $title,
				"areas" => $areas,
				"restaurants" => $eateries,
				"base" => Configures::BASE_PATH
			]))->render();
			
			// レイアウトに組み込んで出力
			$this->renderLayout($title);

		} catch (ServiceException $e) {
			// ログ出力
			error_log($e->getMessage());
			// ユーザ向けメッセージ
			$this->contents[] = "データベースエラーが発生しました。";
      $this->renderLayout("エラー");			
		}
	}

	/**
	 * 地域別レストラン一覧を表示する
	 */
	public function list(Request $request) {

		// リクエストパラメータを取得：送信されていない場合は初期値0とする
		$area = (int)($request->query["area"] ?? 0);

		try {
			
			// 地域別検索要セレクトボックスの元データを取得
			$areaService = new AreaService();
			$areas = $areaService->getAreaList($area);

			// EateryServiceをインスタンス化
			$service = new EateryService();
			$eateries = $service->getEateryList($area);

			// レストラン一覧画面をレンダリング
			$title = "地域別レストラン一覧";
			$this->contents[] = (new View("eateries/list", [
				"title" => $title,
				"areas" => $areas,
				"selectedAreaId" => $area,
				"restaurants" => $eateries,
				"base" => Configures::BASE_PATH
			]))->render();

			// レイアウトに組み込んで出力
			$this->renderLayout($title);
			
		} catch (ServiceException $e) {
			// ログ出力
			error_log($e->getMessage());
			// ユーザ向けメッセージ
			$this->contents[] = "データベースエラーが発生しました。";
      $this->renderLayout("エラー");			
		}
	}

	/**
	 * レストラン詳細を表示する
	 */
	public function detail(Request $request) {
		// リクエストパラメータを取得
		$id = (int)($request->query["id"] ?? 0);

		try {

			// レストラン詳細を取得
			$service = new EateryDetailService();
			$eatery = $service->getDetail($id);

			// レビュリストを取得
			$reviewDetailService = new ReviewDetailService();
			$reviews = $reviewDetailService->getReviewsByEateryId($id);

			// フラッシュメッセージを取得
			$message = $_SESSION["flash_message"] ?? null;
			unset($_SESSION["flash_message"]);
			$error = $_SESSION["error"] ?? null;
			unset($_SESSION["error"]);

			if (isset($_SESSION["reviewDto"])) {
				$reviewDto = $_SESSION["reviewDto"];
				unset($_SESSION["reviewDto"]);
			} else {
				$reviewDto = new ReviewPostDTO(
					eateryId: $eatery->getId(), 
					handleId: 2,
					handleName: "totsuka",
					title: "",
					comment: "",
					rating: ReviewConfigure::DEFAULT_RATING
				);
			}


			$this->contents[] = (new View("eateries/detail", [
				"eatery"  => $eatery,
				"reviews" => $reviews,
				"reviewDto" => $reviewDto,
				"maxRating" => ReviewConfigure::MAX_RATING,
				"selectedRating" => $reviewDto->getRatingAsInteger(),
				"defaultRating" => ReviewConfigure::DEFAULT_RATING,
				"message" => $message,
				"error" => $error,
				"base" => Configures::BASE_PATH
			]))->render();
			// レイアウトに組み込んで出力
			$this->renderLayout("レストラン詳細情報");
			
		} catch (ServiceException $e) {
			// ログ出力
			error_log($e->getMessage());
			// ユーザ向けメッセージ
			$this->contents[] = "データベースエラーが発生しました。";
      $this->renderLayout("エラー");			
		}
	}
}