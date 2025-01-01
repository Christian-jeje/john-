<?php
require 'election_db.php';

$email = ''; // Initialize $email variable

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new Database(); // Create a database instance
    $user = new User($db->getConnection()); // Pass the database connection to the User class

    $email = $_POST['email'] ?? '';  // Assign posted email value to $email
    $password = $_POST['password'] ?? '';  // Assign posted password value to $password

    // Authenticate user
    if ($user->authenticate($email, $password)) {
        header('Location: johnny.php'); // Redirect on successful login
        exit();
    } else {
        echo "<script>alert('Invalid email or password.');</script>";
    }

    $db->closeConnection(); // Close the database connection
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel="icon" href="logo.jpg" type="image/jpg">
    <style>
        body {
            height: auto;
        }
        .hero {
            background: url('class_picture/background1.jpg') center/cover no-repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .hero h1 {
            font-size: 2em;
            margin-left: 70px;
            color: black;
        }

        .hero p {
            font-size: 1.2em;
            margin: 20px 0;
        }

        .hero button {
            background-color: #00d4ff;
            color: #000;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .hero input {
            background-color: rgba(0, 0, 0, 0.6);
            border: 2px solid white;
            border-radius: 10vh;
            padding: 1vh;
            color: white;
            margin-left: 5vh;
        }

        .hero input::placeholder {
            color: white;
            text-align: center;
        }

        .stats {
            display: flex;
            justify-content: space-around;
            padding: 50px 0;
            background-color: #14192e;
        }

        .stat {
            text-align: center;
        }

        .stat h3 {
            color: #00d4ff;
        }
    </style>
</head>
<body>
    <section class="hero">
        <form action="" method="POST">
            <h1>Sign in:</h1>
            <p><input type="text" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required></p>
            <p><input type="password" name="password" id="password" placeholder="Password" required></p>
            <button style="color: white">Submit</button>
            <button><a href="register.php" style="text-decoration: none; color: white">Register</a></button>
        </form>
    </section>
</body>
</html>
