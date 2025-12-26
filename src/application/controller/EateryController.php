<?php
namespace App\application\controller;
use PDO;
use App\infra\config\Configures;
use App\infra\http\Request;
use App\infra\persistence\dao\AreaDAO;
use App\view\View;
use App\application\entity\Area;
use App\application\controller\BaseController;
use App\application\service\AreaService;
use App\application\service\EateryService;

/**
 * レストランに関する処理を制御するコントローラ
 */
class EateryController extends BaseController	{

	/**
	 * レストラン一覧画面を表示する
	 */
	public function index() {
		try {
			
			// 地域別検索要セレクトボックスの元データを取得
			$areaService = new AreaService();
			$areas = $areaService->getAreaList();

			// レストラン一覧用リストを取得
			$eateryService = new EateryService();
			$eateries = $eateryService->getEateries();

			// レストラン一覧画面をレンダリング
			$this->contents[] = (new View("eateries/list", [
				"areas" => $areas,
				"restaurants" => $eateries,
				"base" => Configures::BASE_PATH
			]))->render();
			
			// レイアウトに組み込んで出力
			$this->renderLayout("レストラン一覧");

		} catch (\PDOException $e) {
			// ログ出力
			error_log($e->getMessage());
			// ユーザ向けメッセージ
			$this->contents[] = "データベースエラーが発生しました。";
      $this->renderLayout("エラー");			
		}
	}
}