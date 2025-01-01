<?php
session_start(); // Start the session

// Database connection parameters
$host = 'localhost';
$db_name = 'election_db';
$username = 'root';
$password = '';

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capture user input
    $name = $_POST['name'];
    $age = $_POST['age'];
    $year = $_POST['year'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password

    // Store user details in session
    $_SESSION['name'] = $name;
    $_SESSION['age'] = $age;
    $_SESSION['year'] = $year;
    $_SESSION['email'] = $email;

    // Insert user details into the database
    try {
        $stmt = $pdo->prepare("
            INSERT INTO users (name, age, year, email, password) 
            VALUES (:name, :age, :year, :email, :password)
        ");
        $stmt->execute([
            'name' => $name,
            'age' => $age,
            'year' => $year,
            'email' => $email,
            'password' => $password
        ]);

        // Redirect to a success page or login
        header('Location: johnny.php');
        exit();
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
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
        body{
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

        .hero input{
            background-color: rgb(0,0,0,0.6);
            border: 2px solid white;
            border-radius: 10vh;
            padding: 1vh;
            color: white;
            margin-left: 5vh;
        }
        .hero input::placeholder{
            color: white;
            text-align: center;
        }

        /* Stats Section */
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
        <h1>Register:</h1>
        <p><input type="text" name="name" placeholder="Name" required></p>
        <p><input type="number" name="age" placeholder="Age" required></p>
        <p><input type="text" name="year" placeholder="Year" required></p>
        <p><input type="email" name="email" placeholder="Email" required></p>
        <p><input type="password" name="password" id="password" placeholder="Password" required></p>
        <button type="submit" style="color: white">Register</button>
        <button><a href="login.php" style="text-decoration: none; color: white">Sign in</a></button>
    </form>
    </section>
</body>
</html>
