<?php
namespace App\infra\http;

class Request {

	/**
	 * フィールド
	 */
	public string $method;      // GET/POSTという送信モード
	public string $path;        // URLパターン
	public array  $query = [];  // GETパラメータ
	public array  $body = [];   // POSTパラメータ

	public function __construct() {
		$this->method = $_SERVER["REQUEST_METHOD"];
		$this->path   = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
		parse_str($_SERVER["QUERY_STRING"] ?? "", $query);
		$this->query = $query;
		$this->body = $_POST ?? [];
	} 

}