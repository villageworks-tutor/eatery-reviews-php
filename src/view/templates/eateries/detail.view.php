	<main>
		<article class="detail">
			<h2 class="header__page-title"><?= $eatery->getName() ?></h2>
			<section class="eatery">
				<dl class="eatery__detail-wrapper">
					<dt class="eatery__image">
						<img class="eatery__image--body" src="<?= $base ?>/image/<?= $eatery->getImage() ?>" alt="<?= $eatery->getName() ?>" />
					</dt>
					<dd class="eatery__content">
						<!-- <div class="eatery__name">
							<?= $eatery->getName() ?>
						</div> -->
						<div class="eatery__description">
							<?= $eatery->getDescription() ?>
						</div>
						<div class="eatery__contact">
							<div class="eatery__address"><?= $eatery->getAddress() ?></div>
							<!-- <div class="eatery__phone">000-0000-0000</div> -->
						</div>
					</dd>
				</dl>
			</section>
			<section class="reviews">
				<h2 class="header__section-title">口コミ</h2>
				<div class="review__list">
				<?php if (count($reviews) > 0): // レビュ件数が1以上ある場合は表示する ?>
				<?php foreach ($reviews as $review):	?>
					<dl class="review__item">
						<dd class="review__item-rating"><?= $review->getRating() ?></dd>
						<dt class="review__item-title"><?= $review->getTitle() ?></dt>
						<dd class="review__item-postedAt"><?= $review->getPostedAt() ?></dd>
						<dd class="review__item-reviewer"><?= $review->getHandle() ?></dd>
						<dd class="review__item-comment"><?= $review->getComment() ?></dd>
					</dl>
				<?php endforeach; ?>
				<?php endif; ?>	
				</div>
			</section>

			<section class="post">
				<h2 class="header__section-title">口コミを書き込む</h2>
				<form class="post__form" action="detail.php" method="post">
					<table class="post__controls table">
						<tr class="table__row">
							<th class="table__heading post__heading">
								<label for="name">お名前</label>
							</th>
							<td class="table__cell">
								<input class="post__text" id="name" name="name" />
							</td>
						</tr>
						<tr class="table__row">
							<th class="table__heading post__heading">
								<label for="title">タイトル</label>
							</th>
							<td class="table__cell">
								<input class="post__text" id="title" name="title" />
							</td>
						</tr>
						<tr class="table__row">
							<th class="table__heading post__rating-title">
								評価ポイント
							</th>
							<td class="table__cell">
								<fieldset class="post__fieldset">
									<div class="post__row">
										<div class="post__radio-wrapper">
											<input type="radio" class="post__radio" id="rate1" name="rating" value="1" />
											<label for="rate1">1</label>
										</div>
										<div class="post__radio-wrapper">
											<input type="radio" class="post__radio" id="rate2" name="rating" value="2" />
											<label for="rate2">2</label>
										</div>
										<div class="post__radio-wrapper">
											<input type="radio" class="post__radio" id="rate3" name="rating" value="3" checked />
											<label for="rate3">3</label>
										</div>
										<div class="post__radio-wrapper">
											<input type="radio" class="post__radio" id="rate4" name="rating" value="4" />
											<label for="rate4">4</label>
										</div>
										<div class="post__radio-wrapper">
											<input type="radio" class="post__radio" id="rate5" name="rating" value="5" />
											<label for="rate5">5</label>
										</div>
									</div>
								</fieldset>
							</td>
						</tr>
						<tr class="table__row">
							<th class="table__heading post__heading">
								口コミ								
							</th>
							<td class="table__cell">
								<p class="u-text-error">口コミは必須です</p>
								<textarea class="post__text" id="review" name="review" cols="30" rows="4"></textarea>
							</td>
						</tr>
					</table>
					<div class="post__action">
						<button class="post__button button">投稿</button>
					</div>
				</form>
			</section>
		</article>
	</main>
