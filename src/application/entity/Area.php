<?php
namespace App\application\entity;

/**
 * 地域を表現するクラス
 */
class Area {
	
	/**
	 * フィールド
	 */
	private int $id;      // 地域ID
	private string $name; // 地域名

	public function __construct(int $id, string $name) {
		$this->id = $id;
		$this->name = $name;
	}

	public function getName():string {
		return $this->name;
	}

	public function getId():int {
		return $this->id;
	}

}