<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <?php include __DIR__ . '/../header.php'; ?>
        <div class="container">
            <h1>Login</h1>
            <form action="index.php?action=login" method="post">
                <label for="usernameOrEmail">Username or Email:</label>
                <input type="text" id="usernameOrEmail" name="usernameOrEmail" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
            </form>
            <?php if (isset($_GET['error'])): ?>
                <p class="error-message">Invalid username/email or password.</p>
            <?php endif; ?>
            <a href="index.php?action=register">Register</a>
        </div>
    <?php include __DIR__ . '/../footer.php'; ?>
</body>
</html>
