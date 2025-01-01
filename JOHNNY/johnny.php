<?php
session_start();
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}
else{
// Initialize positions with candidates, votes, and images
if (!isset($_SESSION['positions'])) {
    $_SESSION['positions'] = [
        "President" => [
            ["name" => "Mr. John Roque B. Abina", "votes" => 0, "image" => "img1.jpg"],
            ["name" => "Mr. Emman A. Villarino", "votes" => 0, "image" => "img2.jpg"],
        ],
        "Vice President" => [
            ["name" => "Mr. Christian A. Coquiat", "votes" => 0, "image" => "img4.jpg"],
            ["name" => "Mr. Edson P. Avorque", "votes" => 0, "image" => "img3.jpg"],
        ],
        "Secretary" => [
            ["name" => "Ms. Maricar G. Juanillo", "votes" => 0, "image" => "img14.jpg"],
            ["name" => "Ms. Andrea C. Busa", "votes" => 0, "image" => "img9.jpg"],
        ],
        "Treasurer" => [
            ["name" => "Eva", "votes" => 0, "image" => "img5.jpg"],
            ["name" => "Fred", "votes" => 0, "image" => "img6.jpg"],
        ],
        "P.I.O" => [
            ["name" => "Gina", "votes" => 0, "image" => "img7.jpg"],
            ["name" => "Hank", "votes" => 0, "image" => "img8.jpg"],
        ],
        "Marshall" => [
            ["name" => "Ivy", "votes" => 0, "image" => "img10.jpg"],
            ["name" => "Jack", "votes" => 0, "image" => "img11.jpg"],
        ],
        "Media" => [
            ["name" => "Kathy", "votes" => 0, "image" => "img12.jpg"],
            ["name" => "Liam", "votes" => 0, "image" => "img13.jpg"],
        ],
        "1st Year Representative" => [
            ["name" => "Mia", "votes" => 0, "image" => "img14.jpg"],
            ["name" => "Nina", "votes" => 0, "image" => "img1.jpg"],
        ],
        "2nd Year Representative" => [
            ["name" => "Olly", "votes" => 0, "image" => "img2.jpg"],
            ["name" => "Paul", "votes" => 0, "image" => "img3.jpg"],
        ],
        "3rd Year Representative" => [
            ["name" => "Quincy", "votes" => 0, "image" => "img4.jpg"],
            ["name" => "Rita", "votes" => 0, "image" => "img5.jpg"],
        ],
        "4th Year Representative" => [
            ["name" => "Sam", "votes" => 0, "image" => "img6.jpg"],
            ["name" => "Tina", "votes" => 0, "image" => "img7.jpg"],
        ],
    ];
}

// Handle Voting
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['vote'])) {
    $position = $_POST['position'];
    $candidateIndex = $_POST['candidate_index'];

    if (isset($_SESSION['positions'][$position][$candidateIndex])) {
        $_SESSION['positions'][$position][$candidateIndex]['votes']++;
        echo json_encode(["success" => true]);
        exit();
    } else {
        echo json_encode(["success" => false]);
        exit();
    }
}

// Merge Sort Algorithm
function mergeSort(&$array, $key)
{
    if (count($array) <= 1) {
        return $array;
    }

    $middle = floor(count($array) / 2);
    $left = array_slice($array, 0, $middle);
    $right = array_slice($array, $middle);

    $left = mergeSort($left, $key);
    $right = mergeSort($right, $key);

    return merge($left, $right, $key);
}

function merge($left, $right, $key)
{
    $result = [];

    while (count($left) > 0 && count($right) > 0) {
        if ($left[0][$key] >= $right[0][$key]) {
            $result[] = array_shift($left);
        } else {
            $result[] = array_shift($right);
        }
    }

    while (count($left) > 0) {
        $result[] = array_shift($left);
    }

    while (count($right) > 0) {
        $result[] = array_shift($right);
    }

    return $result;
}

// Finalize Votes and Sort Results
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['finalize'])) {
    foreach ($_SESSION['positions'] as $position => $candidates) {
        $_SESSION['positions'][$position] = mergeSort($candidates, 'votes');
    }
    header("Location: " . $_SERVER['PHP_SELF'] . "?results=true");
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Election Tallying System</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            background-image: url('john.png');/* Replace with your background image */
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            color: white;
        }

        h1{
            margin-left: 400px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 5px;
            width: 500px;
        }


        h2, h3{
            margin-left: 500px;
            text-align: center;
            background-color: rgba(0, 0, 0, 0.6);
            padding: 10px;
            border-radius: 5px;
            width: 350px;
        }

        .candidate {
            display: inline-block;
            text-align: center;
            margin: 20px;
            background-color: rgba(0, 0, 0);
            border-radius: 10px;
            padding: 15px;
        }

        .candidate img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .candidate button {
            padding: 10px 20px;
            font-size: 16px;
            margin-top: 5px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .candidate button:hover {
            background-color: #0056b3;
        }

        form button {
            background-color: #28a745;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            margin: 20px auto;
        }

        form button:hover {
            background-color: #218838;
        }

        .results-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 30px auto;
            padding: 20px;
            border-radius: 10px;
            width: 90%;
            max-width: 1200px;
        }

        .result-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 15px;
            background-color: rgba(0, 0, 0);
            width: auto;
            gap: 10px;
        }

        .result-card img {
            width: 100%;
            max-width: 140px;
            height: 140px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .result-card h4 {
            margin: 10px 0 5px;
            font-size: 18px;
            color: #fff;
        }

        .result-card p {
            font-size: 16px;
            color: #ccc;
        }

    </style>
    <script>
        function vote(position, candidateIndex) {
            const formData = new FormData();
            formData.append('vote', true);
            formData.append('position', position);
            formData.append('candidate_index', candidateIndex);

            fetch("", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("You voted for " + document.getElementById(position + "-" + candidateIndex + "-name").innerText);
                } else {
                    alert("Error voting for candidate.");
                }
            });
        }
    </script>
</head>
<body>
<h1>Election Tallying System</h1>
    <!-- Always show logout button when logged in -->
    <a href="logout.php" style="margin-left: 47%;"><button style="padding: 10px 20px;
            font-size: 16px;
            margin-top: 5px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;">Logout</button></a>

    <?php if (isset($_GET['results'])): ?>
        <h2>Results</h2>
        <?php foreach ($_SESSION['positions'] as $position => $candidates): ?>
            <h3><?php echo $position; ?></h3>
            <div class="results-container">
                <?php foreach ($candidates as $candidate): ?>
                    <div class="result-card">
                        <img src="<?php echo htmlspecialchars($candidate['image']); ?>" alt="<?php echo htmlspecialchars($candidate['name']); ?>">
                        <h4><?php echo htmlspecialchars($candidate['name']); ?></h4>
                        <p>Votes: <?php echo $candidate['votes']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

    <?php else: ?>
        <!-- Display voting options if not in results mode -->
        <?php foreach ($_SESSION['positions'] as $position => $candidates): ?>
            <h2><?php echo $position; ?></h2>
            <div style="display: flex; justify-content: center; flex-wrap: wrap;">
                <?php foreach ($candidates as $index => $candidate): ?>
                    <div class="candidate">
                        <img src="<?php echo file_exists($candidate['image']) ? htmlspecialchars($candidate['image']) : 'images/default.jpg'; ?>" 
                            alt="<?php echo htmlspecialchars($candidate['name']); ?>">
                        <h4 id="<?php echo $position . '-' . $index; ?>-name"><?php echo htmlspecialchars($candidate['name']); ?></h4>
                        <button onclick="vote('<?php echo $position; ?>', <?php echo $index; ?>)">Vote</button>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <form method="POST" action="">
            <button type="submit" name="finalize">Finalize Results</button>
        </form>
    <?php endif; ?>
</body>
</html>