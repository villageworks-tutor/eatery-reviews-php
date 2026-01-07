<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

use App\application\service\Validator;

/**
 * Validatorクラスのテストケース
 */
class ValidatorTest extends TestCase {

	/**
	 * 文字数検査のテストケース
	 */
	#[DataProvider("isInLengthProvider")]
	public function testIsInLength(
		string $target,
		int $length,
		bool $expected
	):void {
		$this->assertSame($expected, Validator::isInLength($target, $length));
	}

	static function isInLengthProvider():array {
		return [
			"文字数範囲内" => ["internet", 10, true],
			"文字数範囲内下限" => ["A", 1, true],
			"文字数範囲内上限" => ["internet", 8, true],
			"文字数範囲外" => ["ポリモルフィズム", 5, false],
			"全角半角混在文字列の文字数範囲内" => ["DAOの導入", 8, true],
			"全角半角混在文字列の文字数範囲上限" => ["DAOの導入", 6, true],
			"全角半角混在文字列の文字数範囲外" => ["DAOの導入", 5, false]
		];
	}


	/**
	 * 範囲検査のテストケース
	 */
	#[DataProvider("isInRangeProvider")]
	public function testIsInRange(
		int $target,
		int $lowerLimit,
		int $upperLimit,
		bool $expected
	):void {
		$this->assertSame($expected, 
											Validator::isInRange($target, $lowerLimit, $upperLimit), 
											"{$target} は {$lowerLimit}〜{$upperLimit} の範囲内であることを確認");
	}

	public static function isInRangeProvider():array {
		return [
			"範囲内"     => [3, 1, 5, true],
			"範囲内下限" => [1, 1, 5, true],
			"範囲内上限" => [5, 1, 5, true],
			"範囲外下限" => [0, 1, 5, false],
			"範囲外上限" => [6, 1, 5, false]
		];
	}

	/**
	 * 必須入力チェックのテスト
	 */
	#[DataProvider("isRequiredProvider")]
	public function testIsRequired(
		string $target,
		bool $expected
	):void {
		$this->assertSame($expected, Validator::isRequired($target));
	}

	public static function isRequiredProvider():array {
		return [
			"文字列" => ["hoge", true],
			"空文字列" => ["", false],
			"半角空白（単一）" => [" ", false],
			"半角空白（複数）" => ["  ", false],
			"全角空白（単一）" => ["　", false],
			"全角空白（複数）" => ["　　　", false],
			"改行（\n）" => ["\n", false],
			"改行（\r\n）" => ["\r\n", false],
			"タブ文字（\t）" => ["\t", false]
		];
	}

}