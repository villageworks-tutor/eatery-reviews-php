	<article class="detail">
		<h2 class="header__page-title"><?= htmlspecialchars($eatery->getName(), ENT_QUOTES, 'UTF-8') ?></h2>
		<section class="eatery">
			<dl class="eatery__detail-wrapper">
				<dt class="eatery__image">
					<img class="eatery__image--body" src="<?= $base ?>/image/<?= htmlspecialchars($eatery->getImage(), ENT_QUOTES, 'UTF-8') ?>" alt="<?= $eatery->getName() ?>" />
				</dt>
				<dd class="eatery__content">
					<div class="eatery__description">
						<?= htmlspecialchars($eatery->getDescription(), ENT_QUOTES, 'UTF-8') ?>
					</div>
					<div class="eatery__contact">
						<div class="eatery__address"><?= htmlspecialchars($eatery->getAddress(), ENT_QUOTES, 'UTF-8') ?></div>
					</div>
				</dd>
			</dl>
		</section>
		<section class="reviews">
			<h2 class="header__section-title">口コミ</h2>
			<?php if ($message): ?>
				<p><?= $message ?></p>
			<?php  endif; ?>
			<div class="review__list">
			<?php if (count($reviews) > 0): // レビュ件数が1以上ある場合は表示する ?>
			<?php foreach ($reviews as $review):	?>
				<dl class="review__item">
					<dd class="review__item-rating"><?=   htmlspecialchars($review->getRating(), ENT_QUOTES, 'UTF-8') ?></dd>
					<dt class="review__item-title"><?=    htmlspecialchars($review->getTitle(), ENT_QUOTES, 'UTF-8') ?></dt>
					<dd class="review__item-postedAt"><?= htmlspecialchars($review->getPostedAt(), ENT_QUOTES, 'UTF-8') ?></dd>
					<dd class="review__item-reviewer"><?= htmlspecialchars($review->getHandle(), ENT_QUOTES, 'UTF-8') ?></dd>
					<dd class="review__item-comment"><?=  nl2br(htmlspecialchars($review->getComment(), ENT_QUOTES, 'UTF-8')) ?></dd>
				</dl>
			<?php endforeach; ?>
			<?php endif; ?>	
			</div>
		</section>

		<section class="post">
			<h2 class="header__section-title"><a href="<?= $base ?>/login">口コミを書き込む</a></h2>
			<form class="post__form" action="<?= $base ?>/post/confirm" method="post">
				<table class="post__controls table">
					<tr class="table__row">
						<th class="table__heading post__heading">
							<label for="name">お名前</label>
						</th>
						<td class="table__cell">
							<input class="post__text" id="name" name="handleName" value="<?= htmlspecialchars($reviewDto->getHandleName(), ENT_QUOTES, 'UTF-8') ?>" />
							<input type="hidden" name="handleId" value="2" />
						</td>
					</tr>
					<tr class="table__row">
						<th class="table__heading post__heading">
							<label for="title">タイトル</label>
						</th>
						<td class="table__cell">
							<input class="post__text" 
										 id="title" 
										 name="title" 
										 value="<?= isset($reviewDto) ? htmlspecialchars($reviewDto->getTitle(), ENT_QUOTES, 'UTF-8') : '' ?>" />
							<span class="u-text-small">省略すると「無題」と表示されます</span>
					</tr>
					<tr class="table__row">
						<th class="table__heading post__rating-title">
							評価ポイント
						</th>
						<td class="table__cell">
							<fieldset class="post__fieldset">
								<div class="post__row">
									<?php for ($i = 1; $i <= $maxRating; $i++): ?>
									<div class="post__radio-wrapper">
										<input class="post__radio" 
													 type="radio"
													 id="rate<?= $i ?>"
													 name="rating"
													 value="<?= $i ?>" 
													 <?= $i === $selectedRating ? "checked" : "" ?>
													 />
										<label for="rate<?= $i ?>"><?= $i ?></label>
									</div>
									<?php endfor; ?>
								</div>
							</fieldset>
						</td>
					</tr>
					<tr class="table__row">
						<th class="table__heading post__heading">
							口コミ								
						</th>
						<td class="table__cell">
							<?php if ($error): ?>
							<div class="u-text-error"><?= $error ?></div>
							<?php endif; ?>
							<textarea class="post__text" 
												id="review" 
												name="review" 
												cols="30" 
												rows="4"
												><?= isset($reviewDto) ? htmlspecialchars($reviewDto->getComment(), ENT_QUOTES, 'UTF-8') : "" ?></textarea>
						</td>
					</tr>
				</table>
				<div class="post__action">
					<button class="post__button button">投稿</button>
					<input type="hidden" name="eateryId" value="<?= $eatery->getId() ?>" />
				</div>
			</form>
		</section>
	</article>
