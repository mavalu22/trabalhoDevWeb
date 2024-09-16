<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php">
                    <img src="/public/images/online.ico" alt="WebForum" class="site-logo">
                </a>
            </div>
            <nav>
                <ul>
                <?php if (isset($_SESSION['user_id'])): ?>
                        <li><span class="username">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                        <li><a href="index.php?action=logout" class="button-logout">Logout</a></li>
                    <?php else: ?>
                        <li><a href="index.php?action=login">Login</a></li>
                        <li><a href="index.php?action=register">Register</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>
