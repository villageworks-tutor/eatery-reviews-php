<?php
use PHPUnit\Framework\TestCase;
use App\application\utils\StringUtils;

/**
 * StringUtilsのstaticメソッドのテストクラス
 */
class StringUtilsTest extends TestCase{
	
	/**
	 * ホワイトスペースのみの文字列は空文字列になる
	 */
	public function testRemoveWhiteSpace_onlyWhiteSpace ():void {
		// ホワイトスペースの文字列配列
		$targets = [" ", "　", "\n", "\r\n", "\t"];
		// 削除できる
		$i = 0;
		foreach ($targets as $target) {
			$this->assertEquals("", StringUtils::removeWhiteSpace($target), "Failed on target: " . json_encode($target));
			$i++;
		}
	}

	/**
	 * ホワイトスペース以外の文字列は削除されない
	 */
	public function testRemoveWhiteSpace_keepNonWhiteSpace():void {
		$target = "a";
		$this->assertSame("a", StringUtils::removeWhiteSpace($target), "Failed on target: " . json_encode($target));
	}

}