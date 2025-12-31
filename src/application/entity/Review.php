<?php
namespace App\appliication\entity;

class Review {
	/**
	 * フィールド
	 */
	private int    $id;        // レビュID
	private int    $eateryId;  // レストランID
	private int    $reviewer;  // 投稿者ID
	private string $title;     // 投稿タイトル
	private string $comment;   // 投稿内容
	private int    $rating;    // 評価ポイント
	private string $image;     // 画像ファイル名
	private string $postedAt;  // 投稿日
	private string $updatedAt; // 更新日

	/**
	 * 引数付きコンストラクタ
	 */
	public function __construct(int $id, int $eateryId, int $reviewer, 
                              string $title, string $comment, int $rating, 
															string $postedAt, string $updatedAt) {
		$this->id = $id;
		$this->eateryId = $eateryId;
		$this->reviewer = $reviewer;
		$this->title = $title;
		$this->comment = $comment;
		$this->rating = $rating;
		$this->image = $image;
		$this->postedAt = $postedAt;
		$this->updatedAt = $updatedAt;
	}

	/**
	 * アクセサメソッド
	 */
	public function getId():int {return $this->id;}
	public function setId(int $id):void {$this->id = $id;}
	public function getEateryId():int {return $this->eateryId;}
	public function setEateryId(int $eateryId):void {$this->eateryId = $eateryId;}
	public function getReviewer():int {return $this->reviewer;}
	public function setReviewer(int $reviewer):void {$this->reviewer = $reviewer;}
	public function getTitle():string {return $this->title;}
	public function setTitle(string $title):void {$this->title = $title;}
	public function getComment():string {return $this->comment;}
	public function setComment(string $comment):void {$this->comment = $comment;}
	public function getRating():int {return $this->rating;}
	public function setRating(int $rating):void {$this->rating = $rating;}
	public function getimage():string {return $this->image;}
	public function setimage(string $image):void {$this->image = $image;}
	public function getPostedAt():string {return $this->postedAt;}
	public function setPostedAt(string $postedAt):void {$this->postedAt = $postedAt;}
	public function getUpdatedAt():string {return $this->updatedAt;}
	public function setUpdatedAt(string $updateAt):void {$this->updatedAt = $updatedAt;}

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
		$output .= "Review = [";
		$output .= "id = "			  . $this->toCanonicalArray()["id"]       . ", ";
		$output .= "eateryId = "	. $this->toCanonicalArray()["eateryId"] . ", ";
		$output .= "reviewer = "  . $this->toCanonicalArray()["reviewer"] . ", ";
		$output .= "title = "     . $this->toCanonicalArray()["title"]    . ", ";
		$output .= "comment = "   . $this->toCanonicalArray()["comment"]  . ", ";
		$output .= "rating = "    . $this->toCanonicalArray()["rating"]   . ", ";
		$output .= "image = "     . $this->toCanonicalArray()["image"]    . ", ";
		$output .= "postedAt = "  . $this->toCanonicalArray()["postedAt"] . ", ";
		$output .= "updatedAt = " . $this->toCanonicalArray()["updatedAt"];
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
					'id'				=> $this->id,
					'eateryId'	=> $this->eateryId,
					'reviewer'	=> $this->reviewer,
					'title'			=> $this->title,
					'comment'		=> $this->comment,
					'rating'    => $this->rating,
					'image'			=> $this->image,
					'postedAt'	=> $this->postedAt,
					'updatedAt'	=> $this->updatedAt
			];
	}

}