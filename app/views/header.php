<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="icon" href="/public/images/online.ico" type="image/x-icon">
    <link rel="stylesheet" href="/public/css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="/public/js/lightdark.js" defer></script>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="index.php">
                    <img src="/public/images/online.ico" alt="WebForum" class="site-logo">
                    <span class="site-title">WebForum</span>
                </a>
            </div>
            <nav>
                <ul>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><span class="username">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></span></li>
                        <li><a href="index.php?action=logout" class="button-logout"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                        <li><a href="index.php?action=sendMessage" class="button-send"><i class="fas fa-paper-plane"></i> Send Message</a></li>
                        <button id="darkModeToggle"> <i class="fas fa-sun"></i> </button>
                    <?php else: ?>
                        <li><a href="index.php?action=login" class="button-login"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                        <li><a href="index.php?action=register" class="button-register"><i class="fas fa-user-plus"></i> Register</a></li>
                        <button id="darkModeToggle"> <i class="fas fa-sun"></i> </button>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
    <main>
