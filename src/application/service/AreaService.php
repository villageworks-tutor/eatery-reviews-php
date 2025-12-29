<?php
namespace App\application\service;

use App\application\service\BaseService;
use App\infra\persistence\dao\AreaDAO;
use App\application\entity\Area;

/**
 * 地域に関する処理を実行するクラス
 */
class AreaService extends BaseService {

  /**
   * フィールド
   */
	private ?array $areaCache = null; // 地域リストのキャッシュ

	public function __construct() {
		parent::__construct(AreaDAO::class);
	}


  /**
   * 地域をすべて取得する
   * @return array 地域クラスのリスト
   */
  public function getAreaList():array {
		// 地域リストのキャッシュがない場合
		if ($this->areaCache === null) {
			// データベース接続オブジェクトを取得
			$areas = $this->dao->findAll();
			// SQL実行結果から地域オブジェクトのリストに変換
			$this->areaCache = [];
			foreach ($areas as $area) {
				$this->areaCache[] = new Area($area["id"], $area["name"]);
			}
		}

		return $this->areaCache;

  }
}