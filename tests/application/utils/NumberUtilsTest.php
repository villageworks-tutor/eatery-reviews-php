<?php
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

use App\application\utils\NumberUtils;

/**
 * NumberUtilクラスのテストクラス
 */
class NumberUtilsTest extends TestCase {

	#[DataProvider('comparisonProvider')]
	public function testComparisons(
		int $limit,
		int $target,
		bool $lessThan,
		bool $lessThanEq,
		bool $greaterThan,
		bool $greaterThanEq
	):void {
		$this->assertSame($lessThan, NumberUtils::isLessThan($target, $limit));
		$this->assertSame($lessThanEq, NumberUtils::isLessThanEqual($target, $limit));
		$this->assertSame($greaterThan, NumberUtils::isGreaterThan($target, $limit));
		$this->assertSame($greaterThanEq, NumberUtils::isGreaterThanEqual($target, $limit));
	}

	public static function comparisonProvider():array {
		return [
			'target < limit' => [0, -1, true, true, false, false],
			'target = limit' => [0, 0, false, true, false, true],
			'target > limit' => [0, 1, false, false, true, true],
		];
	}

}