<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/../header.php'; ?>
        <div class="container">
            <h1>Register</h1>
            <form action="index.php?action=register" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Register</button>
            </form>
            <?php if (isset($_GET['error'])): ?>
                <p class="error-message">Username/Email already in use!</p>
            <?php endif; ?>
            <a href="index.php?action=login">Login</a>
        </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
