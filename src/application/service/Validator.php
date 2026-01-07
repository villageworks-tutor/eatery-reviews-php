<?php
namespace App\application\service;

use App\application\utils\StringUtils;
use App\application\utils\NumberUtils;

/**
 * 入力値検査を実行するクラス
 */
class Validator {

	/**
	 * 文字数検査
	 * @param $target 検査対象文字列
	 * @param $length 最大文字数
	 * @return 検査対象文字列の文字数が最大文字数以内の場合はtrue、それ以外はfalse
	 * 
	 */
	public static function isInLength(string $target, int $length):bool {
		return (NumberUtils::isLessThanEqual(mb_strlen($target), $length));
	}

	/**
	 * 範囲内検査
	 * @param $target     検査対象整数
	 * @param $lowerLimit 範囲下限値
	 * @param $upperLimit 範囲上限値
	 * @return 検査対象整数が範囲下限値以上、範囲下限値以下である場合はtrue、それ以外はfalse
	 */
	public static function isInRange(int $target, int $lowerLimit, int $upperLimit):bool {
		return (NumberUtils::isGreaterThanEqual($target, $lowerLimit) 
							&& NumberUtils::isLessThanEqual($target, $upperLimit));
	}

	/**
	 * 必須入力検査
	 * @param  $target 検査対象文字列
	 * @return 検査対象文字列がホワイトスペース以外であればtrue、ホワイトスペースであればfalse
	 */
	public static function isRequired(string $target):bool {
		$return = true;
		$target = StringUtils::removeWhiteSpace($target);
		if ($target === "") {
			$return = false;
		}
		return $return;
	}

}