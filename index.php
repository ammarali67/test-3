<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 3</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <?php
        // Default contact info
        $phone = '+1 234 567 890';
        $email = 'example@xyz.com';

        // Read contact info from file if it exists
        if (file_exists('submission_data.txt')) {
            list($phone, $email) = explode("\n", file_get_contents('submission_data.txt'));
        }
    ?>
    <header>
        <div class="container">
            <img src="logo.png" alt="Logo" id="logo">
            <div class="header-info">
                <a href="tel:<?php echo htmlspecialchars($phone); ?>" id="phone"><?php echo htmlspecialchars($phone); ?></a>
                <a href="mailto:<?php echo htmlspecialchars($email); ?>" id="email"><?php echo htmlspecialchars($email); ?></a>
            </div>
        </div>
    </header>
    <br>
    <a href="submission.php">Click here</a> to update the header details
</body>
</html>
