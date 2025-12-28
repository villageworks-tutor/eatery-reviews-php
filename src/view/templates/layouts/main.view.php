<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?? "Eatery Reviews" ?></title>
	<link rel="stylesheet" href="<?= $base ?>/css/style.css"/>
</head>
<body>
	<?php include __DIR__."/../partials/header.view.php"; ?>
	<main>
		<?= $content ?>
	</main>
	<?php include __DIR__."/../partials/footer.view.php"; ?>
</body>
</html>