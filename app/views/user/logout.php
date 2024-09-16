<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="/public/css/styles.css">
</head>
<body>
    <h1>Logging out...</h1>
    <?php
    header('Location: login.php');
    exit();
    ?>
</body>
</html>
