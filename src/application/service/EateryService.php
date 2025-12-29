<?php
namespace App\application\service;

use App\application\entity\Eatery;
use App\application\service\BaseService;
use App\infra\persistence\dao\EateryDAO;

/**
 * レストランに関する処理を実行するクラス
 */
class EateryService extends BaseService {

	private const AREA_ALL = 0;

	/**
	 * コンストラクタ
	 */
	public function __construct() {
		parent::__construct(EateryDAO::class);
	}

	/**
	 * すべてのレストランを取得する（初期表示）
	 * @return レストランリスト
	 */
	public function getAllEatery() {
		$eateries = $this->dao->findAll();
		$eateryList = $this->convertResultsToList($eateries);
		return $eateryList;
	}

	/**
	 * 地域別レストランリストを取得する
	 * @param  $area 地域ID
	 * @return 地域別レストランリスト
	 */
	public function getEateryList(int $area):array {
		$dao = new EateryDAO();
		$eateries = null;
		if ($area === self::AREA_ALL) {
			$eateries = $dao->findAll();
		} else {
			$eateries = $dao->findByArea($area);
		}
		$eateryList = $this->convertResultsToList($eateries);
		return $eateryList;
	}

	/**
	 * 結果セットをレストランオブジェクトを要素とするリストに変換する
	 * @param  $eateries 結果セット
	 * @return レストランオブジェクトを要素とするリスト
	 */
	private function convertResultsToList(array $eateries):array {
		$converted = [];
		foreach ($eateries as $eatery) {
			$converted[] = new Eatery(
				id: $eatery["id"], 
				area: $eatery["area"], 
				name: $eatery["name"], 
				address: $eatery["address"], 
				description: $eatery["description"], 
				image: $eatery["image"]);
		}
		return $converted;
	} 

}