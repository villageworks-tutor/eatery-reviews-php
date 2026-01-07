<?php
namespace App\application\utils;

class NumberUtils {

	/**
	 * 判定対象数が制限値未満であるかを判定する
	 * @param  $limit  制限値
	 * @param  $target 判定対象数
	 * @return 判定対象数が制限値未満である場合はtrue、それ以外はfalse
	 */
	public static function isLessThan(int $target, int $limit):bool {
		if ($target < $limit) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 判定対象数が制限値以下であるかを判定する
	 * @param  $limit  制限値
	 * @param  $target 判定対象数
	 * @return 判定対象数が制限値以下である場合はtrue、それ以外はfalse
	 */
	public static function isLessThanEqual(int $target, int $limit):bool {
		return ($target <= $limit);
	}


	/**
	 * 判定対象数が制限値以上であるかを判定する
	 * @param  $limit  制限値
	 * @param  $target 判定対象数
	 * @return 判定対象数が制限値以上である場合はtrue、それ以外はfalse
	 */
	public static function isGreaterThanEqual(int $target, int $limit):bool {
		return ($target >= $limit);
	}

	/**
	 * 判定対象数が制限値超であるかを判定する
	 * @param  $limit  制限値
	 * @param  $target 判定対象数
	 * @return 判定対象数が制限値超である場合はtrue、それ以外はfalse
	 */
	public static function isGreaterThan(int $target, int $limit):bool {
		return ($target > $limit);
	}

}