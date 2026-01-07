<?php
namespace App\application\utils;

class StringUtils {

	/**
	 * 全角半角スペースを除去する
	 * @param $target 処理対象文字列
	 */
	public static function removeSpace($target):string {
		$pattern = " 　"; // 半角と全角の空白
		return self::replaceChar($pattern, "", $target);
	}

	/**
	 * ホワイトスペースを除去する
	 * @param $target 処理対象文字列
	 * ホワイトスペースとして対象となるもの：
	 */
	public static function removeWhiteSpace($target):string {
		$pattern = "\n\r\n\t";
		return self::replaceChar($pattern, "", self::removeSpace($target));
	}

	/**
	 * 文字列置換する
	 * @param  $pattern     置換対象パターン文字列
	 * @param  $replacement 置換後の文字列
	 * @param  $target      置換対象パターンを含む文字列
	 * @return 置換対象パターンを置換後の文字列で置換された文字列
	 */
	public static function replaceChar(string $pattern, string $replacement, string $target):string {
		$regexpress = self::createRegPattern($pattern);
		return preg_replace($regexpress, $replacement, $target);	
	}

	/**
	 * 正規表現パターンを生成する
	 * @param  $target 正規表現パターン文字列
	 * @return 正規表現
	 */
	private static function createRegPattern(string $target):string {
		$escaped = preg_quote($target, "/"); // パターン文字列内の「/」を正規表現無効化
		return "/[$escaped]/u";
	}
}