<?php
    $admin_password = 'admin123';

    if (isset($_POST['password']) && $_POST['password'] == $admin_password) {
        session_start();
        $_SESSION['admin_logged_in'] = true;
    }

    if (isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php");
        exit;
    }

    if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
        echo '<!DOCTYPE html><head><title>Test 3 - Admin Login</title></head><body><form method="POST">
                <input type="password" name="password" placeholder="Enter admin password">
                <input type="submit" value="Login">
            </form></body></html>';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_header_info'])) {
        $phone = $_POST['phone'];
        $email = $_POST['email'];

        // Save phone and email to a file
        file_put_contents('submission_data.txt', "$phone\n$email");

        if (isset($_FILES['logo']) && $_FILES['logo']['error'] == UPLOAD_ERR_OK) {
            move_uploaded_file($_FILES['logo']['tmp_name'], 'logo.png');
        }
        header("Location: index.php");
    }

    // Read submission info from file
    if (file_exists('submission_data.txt')) {
        list($phone, $email) = explode("\n", file_get_contents('submission_data.txt'));
    } else {
        $phone = '+1 234 567 890';
        $email = 'example@xyz.com';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test 2 - Update Header Settings</title>
</head>
<body>
    <form method="POST">
        <input type="submit" name="logout" value="Logout">
    </form>
    <h1>Header Settings:</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="logo">Upload New Logo:</label>
        <input type="file" name="logo" id="logo"><br><br>

        <label for="phone">Phone Number:</label>
        <input type="text" name="phone" id="phone" value="<?php echo htmlspecialchars($phone); ?>"><br><br>

        <label for="email">Email Address:</label>
        <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>"><br><br>

        <input type="submit" name="update_header_info" value="Update">
    </form>
</body>
</html>
