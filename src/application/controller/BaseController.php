<?php
namespace App\application\controller;
use App\infra\config\Configures;
use App\view\View;

/**
 * すべての業務コントローラが継承する基底コントローラ
 */
class BaseController {

	/**
	 * フィールド
	 */
	protected array $contents; // 表示するコンテンツのリスト

	/**
	 * 画面タイトルとコンテンツを組み込んで出力する
	 * @param $title   タイトルバーに表示するタイトル
	 */
	protected function renderLayout(string $title):void {
		// $contentsを結合
		$fullContent = implode("\n", $this->contents);
		// コンテンツの出力
		echo (new View("layouts/main", [
				"title" => $title, 
				"content" => $fullContent, 
				"base" => Configures::BASE_PATH
			]))->render();	
	}
}
