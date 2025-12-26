<?php
namespace App\application\controller;
use PDO;
use App\infra\config\Configures;
use App\infra\http\Request;
use App\infra\persistence\Database;
use App\view\View;
use App\application\entity\Area;
use App\application\controller\BaseController;

/**
 * レストランに関する処理を制御するコントローラ
 */
class EateryController extends BaseController	{

	/**
	 * フィールド
	 */
	private ?array $areaCache = null; // 地域リストのキャッシュ

	/**
	 * レストラン一覧画面を表示する
	 */
	public function index() {
		try {
			// 地域別検索要セレクトボックスの元データを取得
			$areas = [];
			$areas = $this->getAreaList();

			// レストラン一覧画面をレンダリング
			$this->contents[] = (new View("eateries/list", [
				"areas" => $areas,
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

	/**
	 * 地域リストを取得する
	 */
	private function getAreaList():array {
		// 地域リストのキャッシュがない場合
		if ($this->areaCache === null) {
			// データベース接続オブジェクトを取得
			$pdo = Database::connect();
			$stmt = $pdo->query("SELECT id, name FROM areas ORDER BY id");
			$areas = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// SQL実行結果から地域オブジェクトのリストに変換
			$this->areaCache = [];
			foreach ($areas as $area) {
				$this->areaCache[] = new Area($area["id"], $area["name"]);
			}
		}

		return $this->areaCache;

	}

}
