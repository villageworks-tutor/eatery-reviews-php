<?php
namespace App;

require_once __DIR__."/../vendor/autoload.php";

use App\infra\config\Configures;
use App\infra\router\Router;
use App\infra\router\Route;
use App\infra\http\Request;
use App\application\controller\EateryController;

// ※通常構成との重要な違い
// 一般的な VirtualHost 構成では、DocumentRoot をプロジェクトの public/ に設定するため
// URL の先頭は常に「/」となり、ルーティングにプロジェクト名を含める必要はない。
//
// しかし本環境では、VirtualHost で AliasMatch を使用しているため、
// URL が「/プロジェクト名/...」という構成になる仕様になっている。
// 例）/eatery-reviews/about
//
// この特殊なURL構成に合わせるため、ルーティングのパスも
// 「/eatery-reviews/...」形式に統一する必要がある。
// その煩雑さを避けるため、先頭パスを $base として共通化している。
$base = Configures::BASE_PATH;

// ルーティング設定
$router = new Router();
// $router->addRoute(new Route("{$base}/", HomeController::class, "index"));
// $router->addRoute(new Route("{$base}/hoge", HomeController::class, "hoge"));
$router->addRoute(new Route("{$base}/", EateryController::class, "index"));

// リクエストオブジェクトをインスタンス化
$request = new Request();

// ルートの判定
$route = $router->match($request);
if ($router === null) {
	http_response_code(404);
	echo "ページが見つかりません";
	exit;
}

// 呼び出すコントローラとメソッドを決定
$controller = new $route->controller();
$handler = $route->handler;
// パラメータの受け渡しは$requestごと
$controller->$handler($request);

