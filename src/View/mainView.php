<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Einfache Blog-Ansicht</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: auto; }
        .post { background: #f4f4f4; margin-bottom: 20px; padding: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Mein einfacher Blog</h1>
        <?php foreach ($posts as $post): ?>
            <div class="post">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?= htmlspecialchars($post['content']) ?></p>
                <small>Veröffentlicht am: <?= htmlspecialchars($post['created_at']) ?></small>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>