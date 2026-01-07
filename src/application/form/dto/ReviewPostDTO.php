<?php
namespace App\application\form\dto;

/**
 * レビュ確認用の情報を管理するDTOクラス
 */
class ReviewPostDTO {
	
	/**
	 * フィールド
	 */
	private string $eateryId;   // レストランID
	private string $handleId;   // 投稿者ID
	private string $handleName; // 投稿者ハンドル名
	private string $title;      // 投稿タイトル
	private string $comment;    // 投稿内容
	private string $rating;     // 評価ポイント

	/**
	 * 引数付きコンストラクタ
	 */
	public function __construct(string $eateryId, string $handleId, string $handleName, string $title, 
	                            string $comment, string $rating) {
		$this->eateryId = $eateryId;
		$this->handleId = $handleId;
		$this->handleName = $handleName;
		$this->title = $title;
		$this->comment = $comment;
		$this->rating = $rating;
	}

	/**
	 * アクセサメソッド
	 */
	public function getEateryId():string {return $this->eateryId;}
	public function setEateryId(string $eateryId):void {$this->eateryId = $eaterId;}
	public function getHandleId():string {return $this->handleId;}
	public function setHandleId(string $handleId):void {$this->handleId = $handleId;}
	public function getHandleName():string {return $this->handleName;}
	public function setHandleName(string $handleName):void {$this->handleName = $handleName;}
	public function getTitle():string {return $this->title;}
	public function setTitle(string $title):void {$this->title = $title;}
	public function getComment():string {return $this->comment;}
	public function setComment(string $comment):void {$this->comment = $comment;}
	public function getRating():string {return $this->rating;}
	public function setRating(string $rating):void {$this->rating = $rating;}

	public function getRatingAsInteger(): int {
		return (int) $this->rating;
	}

	/**
	 * テストおよび比較処理のための正規文字列表現を返す。
	 *
	 * このメソッドは以下の用途を想定している：
	 * - PHPUnit による assertion
	 * - スナップショット的な比較処理
	 *
	 * 出力形式は安定性を前提とするため、軽率に変更してはならない。
	 * 人間向けの表示が必要な場合は toString() を使用すること。
	 */
	public function toCanonicalString(): string {
			return json_encode(
					$this->toCanonicalArray(),
					JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR
			);
	}
	
	/**
	 * 人間が読むことを目的とした文字列表現を返す。
	 *
	 * 主な用途：
	 * - ログ出力
	 * - デバッグ
	 *
	 * 表示形式は自由に変更される前提であり、
	 * assertion や機械的な比較処理には使用してはならない。
	 */
	public function toString():string {
		$output = "";
		$output .= "ReviewPostDTO = [";
		$output .= "eateryId = "   . $this->toCanonicalArray()["eateryId"]   . ", ";
		$output .= "handleId = "   . $this->toCanonicalArray()["handleId"]   . ", ";
		$output .= "handleName = " . $this->toCanonicalArray()["handleName"] . ", ";
		$output .= "title = "      . $this->toCanonicalArray()["title"]      . ", ";
		$output .= "comment = "    . $this->toCanonicalArray()["comment"]    . ", ";
		$output .= "rating = "     . $this->toCanonicalArray()["rating"]     . ", ";
		$output .= "]";
		return $output;
	}

	/**
	 * この DTO の正規（カノニカル）表現。
	 *
	 * - シリアライズおよび比較処理における唯一の基準となる表現
	 * - toCanonicalString() や jsonSerialize() などから内部的に利用される
	 * - 配列としての無秩序な利用を防ぐため、意図的に private にしている
	 *
	 * この DTO を配列として外部に公開する必要が生じた場合は、
	 * toArray() を public にするのではなく、
	 * 役割に応じた専用メソッドを新たに定義すること。
	 */
	private function toCanonicalArray(): array {
			return [
					'eateryId'   => $this->eateryId,
					'handleId'   => $this->handleId,
					'handleName' => $this->handleName,
					'title'      => $this->title,
					'comment'    => $this->comment,
					'rating'     => $this->rating
			];
	}

}