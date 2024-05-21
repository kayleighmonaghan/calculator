<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Calculator</h1>
    <div class="container">
        <!-- action points towards php inside this doc rather than pointing 
        to an external php file -->
        <form action="<?php echo htmlspecialchars($_SERVER
        ["PHP_SELF"]); ?>" method="post">
            <input type="number" name="num01" placeholder="number input" required />
            <select name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" name="num02" placeholder="number input" required />
            <button>calculate</button>
        </form>
    </div>
    <footer>
        <p>Created by <a href="https://github.com/kayleighmonaghan">Kayleigh Monaghan</a>👩‍💻</p>
    </footer>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // fetch data from inputs
            $num01 = filter_input(INPUT_POST, "num01", 
            FILTER_SANITIZE_NUMBER_FLOAT);

            $num02 = filter_input(INPUT_POST, "num02", 
            FILTER_SANITIZE_NUMBER_FLOAT);

            $operator = htmlspecialchars($_POST["operator"]);

            // error handlers - user must fill inputs
            $errors = false;

            if (empty($num01) || empty($num02) || empty($operator)) {
                echo "<p class='error-msg'>Please fill in all fields.</p>";
                $errors = true;
            }

            if (!is_numeric($num01) || !is_numeric($num02)) {
                echo "<p class='error-msg'>Only write numbers, silly!</p>";
                $errors = true;
            }

            // if no errors: calculate numbers
            if (!$errors) {
                $value = 0;

                switch ($operator) {
                    case "add":
                        $value = $num01 + $num02;
                        break;
                    case "subtract":
                        $value = $num01 - $num02;
                        break;
                    case "multiply":
                        $value = $num01 * $num02;
                        break;
                    case "divide":
                        $value = $num01 / $num02;
                        break;
                    default: 
                        echo "<p>Uh oh! Something went wrong o_O</p>";
                }

                echo "<p class='result'>result = " . $value . "</p>";
                echo "<button class='reset-btn'><a href='index.php'>reset</a></button";
            }
        }
    ?>
</body>
</html>