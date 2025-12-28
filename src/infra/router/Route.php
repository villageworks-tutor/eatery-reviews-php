<?php
namespace App\infra\router;

/**
 * URLパスに紐づくコントローラとメソッドを管理するクラス
 */
class Route {
	/**
	 * フィールド
	 */
	public string $path;       // URLパス
	public string $controller; // コントローラ名
	public string $handler;    // 呼び出されるメソッド名

	/**
	 * コンストラクタ
	 * @param $path       URLパス
	 * @param $controller コントロール名
	 * @param $handler    呼び出されるメソッド名
	 */
	public function __construct(string $path, string $controller, string $handler) {
		$this->path = $path;
		$this->controller = $controller; 
		$this->handler = $handler;
	}

}