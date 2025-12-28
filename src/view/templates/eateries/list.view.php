		<article class="list">
			<h2 class="header__page-title"><?= $title ?></h2>

			<!-- 検索条件 -->
			<section class="criteria">
				<form class="criteria__form" action="<?= $base ?>/list" method="get">
					<div class="criteria__controls">
						<div class="criteria__select-wrapper">
							<select class="criteria__select" name="area">
								<option class="criteria__option" value="0">地域を選択してください</option>
								<?php foreach ($areas as $area): ?>
									<?php if ($area->getId() === $selectedAreaId): ?>
									<option selected class="criteria__option" value="<?= $area->getId() ?>">
										<?= $area->getName() ?>
									</option>
									<?php else: ?>
									<option class="criteria__option" value="<?= $area->getId() ?>">
										<?= $area->getName() ?>
									</option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<button class="criteria__button button">検索</button>
					</div>
				</form>
			</section>

			<!-- 検索結果 -->
			<section class="result">
				<div class="result__list">
					<?php foreach ($restaurants as $restaurant): ?>
					<dl class="result__item u-shadow-sm">
						<dt class="result__item-image">
							<img src="<?= $base ?>/img/<?= $restaurant->getImage() ?>" 
							     alt="<?= $restaurant->getName() ?>" 
									 width="110">
						</dt>
						<dd class="result__item-content">
							<div class="result__item-name">
								<?= $restaurant->getName() ?>
							</div>
							<div class="result__item-description">
								<?= $restaurant->getDescription() ?>
							</div>
							<div class="result__item-link">
								<a class="result__item-link-anchor" href="detail.html?id=<?= $restaurant->getId() ?>">詳細</a>
							</div>
						</dd>
					</dl>
					<?php endforeach; ?>
				</div>
			</section>
		</article>
