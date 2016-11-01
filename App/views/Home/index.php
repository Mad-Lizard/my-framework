<!DOCTYPE html>
<html lang="ru">
    <meta charset="UTF-8">

    <html>
        <head>
            <title>Home</title>

        </head>
        <body>
            <h1>Добро пожаловать!</h1>
            <p>Привет, <?php echo htmlspecialchars($name); ?>!</p>

            <ul>
                <?php foreach ($colours as $colour): ?>
                <li><?php echo htmlspecialchars($colour); ?></li>
                <?php endforeach; ?>
            </ul>

        </body>
    </html>
