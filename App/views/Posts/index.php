<!DOCTYPE html>
<html lang="ru">
    <meta charset="UTF-8">

    <html>
        <head>
            <title>Posts</title>

        </head>
        <body>
            <h1>Посты</h1>
        <ul>
                <?php foreach ($posts as $post): ?>
                <?php echo '<h2>';
                echo htmlspecialchars($post['title']);
                echo '</h2><p>';
                echo htmlspecialchars($post['content']);
                echo '</p>'; ?>
                <?php endforeach; ?>
        </ul>    

        </body>
    </html>

