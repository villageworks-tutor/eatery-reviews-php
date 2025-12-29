<?php
namespace App\application\entity;

/**
 * 詳細表示用の情報を管理するEntityクラス
 */
class EateryDetail {
		
	/**
	 * フィールド
	 */
	private int $id;						 // レストランID
	private int $areaId;				 // 地域ID
	private string $areaName;		// 地域名
	private string $name;				// レストラン名
	private string $address;		 // 所在地
	private string $description; // 紹介文
	private string $image;			 // 画像ファイル名

	/**
	 * コンストラクタ
	 * @param $id					レストランID
	 * @param $areaId			地域ID
	 * @param $areaName		地域名
	 * @param $name				レストラン名
	 * @param $address		 所在地
	 * @param $description 紹介文
	 * @param $image			 画像ファイル名
	 */
	public function __construct($id, $areaId, $areaName, $name, $address, $description, $image) {
		$this->id = $id;
		$this->areaId = $areaId;
		$this->areaName = $areaName;
		$this->name = $name;
		$this->address = $address;
		$this->description = $description;
		$this->image = $image;
	}

	public function getId():int {
		return $this->id;
	}

	public function getAreaId():int {
		return $this->areaId;
	}

	public function getAreaName():string {
		return $this->areaName;
	}

	public function getName():string {
		return $this->name;
	}

	public function getAddress():string {
		return $this->address;
	}

	public function getDescription():string {
		return $this->description;
	}

	public function getImage():string {
		return $this->image;
	}

	public function setId(int $id):void {
		$this->id = $id;
	}

	public function setAreaId(int $areaId):void {
		$this->areaId = $areaId;
	}

	public function setAreaName(string $areaName):void {
		$this->areaName = $areaName;
	}

	public function setName(string $name):void {
		$this->name = $name;
	}

	public function setAddress(string $address):void {
		$this->address = $address;
	}

	public function setDescription(string $description):void {
		$this->description = $description;
	}

	public function setImage(string $image):void {
		$this->image = $image;
	}

	/**
	 * テストおよび比較処理のための正規文字列表現を返す。
	 *
	 * このメソッドは以下の用途を想定している：
	 * - PHPUnit による assertion
	 * - スナップショット的な比較処理
	 *
	 * 出力形式は安定性を前提とするため、軽率に変更してはならない。
	 * 人間向けの表示が必要な場合は toString() を使用すること。
	 */
	public function toCanonicalString(): string {
			return json_encode(
					$this->toCanonicalArray(),
					JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
			);
	}
	
	/**
	 * 人間が読むことを目的とした文字列表現を返す。
	 *
	 * 主な用途：
	 * - ログ出力
	 * - デバッグ
	 *
	 * 表示形式は自由に変更される前提であり、
	 * assertion や機械的な比較処理には使用してはならない。
	 */
	public function toString():string {
		$output = "";
		$output .= "EateryDetail = [";
		$output .= "id = "			    . $this->toCanonicalArray()["id"] . ", ";
		$output .= "areaId = "	    . $this->toCanonicalArray()["areaId"] . ", ";
		$output .= "areaName = "    . $this->toCanonicalArray()["areaName"] . ", ";
		$output .= "name = "        . $this->toCanonicalArray()["name"] . ", ";
		$output .= "address = "     . $this->toCanonicalArray()["address"] . ", ";
		$output .= "description = " . $this->toCanonicalArray()["description"] . ", ";
		$output .= "image = "       . $this->toCanonicalArray()["image"];
		$output .= "]";
		return $output;
	}

	/**
	 * この DTO の正規（カノニカル）表現。
	 *
	 * - シリアライズおよび比較処理における唯一の基準となる表現
	 * - toCanonicalString() や jsonSerialize() などから内部的に利用される
	 * - 配列としての無秩序な利用を防ぐため、意図的に private にしている
	 *
	 * この DTO を配列として外部に公開する必要が生じた場合は、
	 * toArray() を public にするのではなく、
	 * 役割に応じた専用メソッドを新たに定義すること。
	 */
	private function toCanonicalArray(): array {
			return [
					'id'					=> $this->id,
					'areaId'			=> $this->areaId,
					'areaName'		=> $this->areaName,
					'name'				=> $this->name,
					'address'		  => $this->address,
					'description' => $this->description,
					'image'			  => $this->image,
			];
	}

}
