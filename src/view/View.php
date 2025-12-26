<?php
namespace App\view;

/**
 * テンプレートにレンダリングするクラス
 */
class View {

	/**
	 * フィールド
	 */
	private string $template; // テンプレート名（templateパッケージ内でのパス表記）
	private array $params;    // テンプレートに渡すパラメータの連想配列

	/**
	 * コンストラクタ
	 * @param $template テンプレート名
	 * @param $params   パラメータの連想配列
	 */
	public function __construct(string $template, array $params = []) {
		$this->template = $template;
		$this->params = $params;
	}

	/**
	 * レンダリングする
	 */
	public function render():string {
		// 連想配列 $params をテンプレート内で 変数として直接使える ように展開
		extract($this->params);
		// テンプレート読み込み中の出力を 一旦バッファに貯めて文字列として取得
		ob_start(); 
		include $this->createTemplatePath();
		return ob_get_clean();
	}

	/**
	 * テンプレートのフルパスを生成する
	 * TODO: 存在チェックがあるとより安全
	 */
	private function createTemplatePath():string {
		return __DIR__."/templates/{$this->template}.view.php";
	}

}