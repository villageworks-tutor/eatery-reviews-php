<?php
namespace App\infra\router;
use App\infra\http\Request;
use App\infra\router\Route;

/**
 * 複数のRouteオブジェクトを配列として管理し、URLパスに対応するRouteおんっ振ジェクトを提供するクラス
 */
class Router {

	/**
	 * フィールド
	 */
	private array $routes = []; // Routeクラスのインスタンスの配列

	/**
	 * Routeオブジェクトを登録する
	 */
	public function addRoute(Route $route):void {
		$this->routes[] = $route;
	}

	/**
	 * Requestオブジェクトのpathに一致するRouteオブジェクトを取得する
	 * @param  $request Requestクラスのインスタンス
	 * @return Requestオブジェクトのpathに一致するRouteオブジェクトが見つかった場合はそのRouteオブジェクト、それ以外はnull
	 */
	public function match(Request $request):?Route {
		foreach ($this->routes as $route) {
			if ($route->path === $request->path) {
				return $route;
			}
		}
		return null;
	}

}