<?php
namespace App\application\entity;

class Eatery {

	/**
	 * フィールド
	 */
	private int $id;             // レストランID
	private int $area;           // 地域ID
	private string $name;        // レストラン名
	private string $address;     // 所在地
	private string $description; // 紹介文
	private string $image;       // 画像ファイル名

	/**
	 * コンストラクタ
	 * @param $id          // レストランID
	 * @param $area        // 地域ID
	 * @param $name        // レストラン名
	 * @param $address     // 所在地
	 * @param $description // 紹介文
	 * @param $image       // 画像ファイル名
	 */
	public function __construct(int $id, int $area, string $name, string $address, string $description, string $image) {
		$this->id = $id;
		$this->area = $area;
		$this->name = $name;
		$this->address = $address;
		$this->description = $description;
		$this->image = $image;
	}

	public function getId():int {
	  return $this->id;
	}
	public function  setId(int $id):void {
	  $this->id = $id;
	}
	public function getArea():int {
	  return $thiss->area;
	}
	public function setArea(int $area):void {
	  $this->area = $area;
	}
	public function getName():string {
	  return $this->name;
	}
	public function setName(string $name):void {
	  $this->name = $name;
	}
	public function getAddress():string {
	  return $this->address;
	}
	public function setAddress(string $address):void {
	  $this->address = $address;
	}
	public function getDescription():string {
	  return $this->description;
	}
	public function setDescription(string $description):void {
	  $this->description = $description;
	}
	public function getImage():string {
	  return $this->image;
	}
	public function setImage(string $image):void {
	  $this->image = $image;
	}

}