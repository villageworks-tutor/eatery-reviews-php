<?php
namespace App\application\controller;
use App\infra\config\Configures;
use App\infra\http\Request;
use App\view\View;

/**
 * 店舗に関する業務を制御するコントローラ
 */
class EateryController {
  /**
   * 全レストランを表示する画面を初期表示画面として表示する
   */
  public function index() {
    // メインコンテンツの登録
    $content = (new View("eateries/list", ["base" => Configures::BASE_PATH]))->render();
    // ページの呼び出し
    $title = "レストラン一覧";
    echo (new View("layouts/main", ["title" => $title, "content" => $content, "base" => Configures::BASE_PATH]))->render();
  }
}
