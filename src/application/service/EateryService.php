<?php
namespace App\application\service;
use App\infra\persistence\dao\EateryDAO;
use App\application\entity\Eatery;

/**
 * レストランに関する処理を実行するクラス
 */
class EateryService {
	/**
	 * すべてのレストランを取得する
	 * @return レストランリスト
	 */
	public function getEateries() {
		$dao = new EateryDAO();
		$eateries = $dao->findAll();
		$eateryList = [];
		foreach ($eateries as $eateryData) {
			$eateryList[] = new Eatery(
				id: $eateryData["id"], 
				area: $eateryData["area"], 
				name: $eateryData["name"], 
				address: $eateryData["address"], 
				description: $eateryData["description"], 
				image: $eateryData["image"]);
		}
		return $eateryList;
	}
}