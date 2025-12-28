<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>矩形面積計算</title>
</head>
<body>
    <h1>矩形の面積計算</h1>
    <form action="/eatery-reviews-php/hoge" method="POST">
        <label>縦:
            <input type="number" step="1" name="height" required>
        </label>
        <br>
        <label>横:
            <input type="number" step="1" name="width" required>
        </label>
        <br>
        <button type="submit">計算</button>
    </form>

    <?php if ($area !== null): ?>
        <p>面積は <strong><?= htmlspecialchars($area) ?></strong> です。</p>
    <?php endif; ?>
</body>
</html>
