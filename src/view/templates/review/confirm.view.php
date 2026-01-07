<section class="review">
	<article class="review__body review__body--confirm">
		<h2 class="header__page-title"><?= $title ?></h2>
		<div class="review__body-wrapper">
			<p>以下の内容で投稿しますか？</p>
			<table class="review__table">
				<tr class="table__row">
					<th class="review__heading table__heading">タイトル</th>
					<td class="review__cell table__cell"><?= $review->getTitle() ?></td>
				</tr>
				<tr class="table__row">
					<th class="review__heading table__heading">投稿者</th>
					<td class="review__cell table__cell"><?= $review->getHandleName() ?></td>
				</tr>
				<tr class="table__row">
					<th class="review__heading table__heading">評価ポイント</th>
					<td class="review__cell table__cell"><?= $review->getRating() ?></td>
				</tr>
				<tr class="table__row">
					<th class="review__heading table__heading">投稿内容</th>
					<td class="review__cell table__cell"><?= $review->getComment() ?></td>
				</tr>
			</table>
			<form  method="post">
				<div class="review__controls">
					<button class="review__button--edit button" 
									formaction="<?= $base ?>/post/edit" 
									formaction="post">修正する</button>
					<button class="review__button--post button" 
									formaction="<?= $base ?>/post/execute" 
									formaction="post">投稿する</button>
				</div>
				<input type="hidden" name="eateryId" value="<?= $review->getEateryId() ?>" />
				<input type="hidden" name="title" value="<?= $review->getTitle() ?>" />
				<input type="hidden" name="handleId" value="<?= $review->getHandleId() ?>>" />
				<input type="hidden" name="handleName" value="<?= $review->getHandleName() ?>" />
				<input type="hidden" name="comment" value="<?= $review->getComment() ?>" />
				<input type="hidden" name="rating" value="<?= $review->getRating() ?>" />
			</form>
		</div>
	</article>
</section>