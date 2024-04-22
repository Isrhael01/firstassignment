<?php

class CollatzSequence {
    protected $input;
    protected $highestNumber;
    protected $totalIterations;

    public function __construct($input) {
        $this->input = $input;
        $this->highestNumber = $input;
        $this->totalIterations = 0;
    }

    public function generateSequence() {
        $x = $this->input;
        $numHighest = $this->highestNumber;
        $count = $this->totalIterations;

        while ($x > 1) {
            if ($x % 2 == 0) {
                $x = $x / 2;
            } else {
                $x = ($x * 3) + 1;
            }
            echo "Iteration: ".$x;
            echo "<hr>";
            echo "<br>";
            $count++;
            if ($numHighest < $x) {
                $numHighest = $x;
            }
        }

        echo $this->input." ";
        echo "<hr>";
        echo "<br>";

        echo "Highest Number: ".$numHighest." ";
        echo "<hr>";
        echo "<br>";
        echo "Total Iterations: ".$count;
    }
}

class CollatzStatistics extends CollatzSequence {
    public function calculateStatistics($n, $m, $maxIterations = 1000, $maxNumber = 10000) {
        $histogram = [];

        for ($i = $n; $i <= $m && $i <= $maxNumber; $i++) {
            $x = $i;
            $iterations = 0;

            while ($x > 1 && $iterations < $maxIterations) {
                if ($x % 2 == 0) {
                    $x = $x / 2;
                } else {
                    $x = ($x * 3) + 1;
                }
                $iterations++;

                if (!isset($histogram[$x])) {
                    $histogram[$x] = 1;
                } else {
                    $histogram[$x]++;
                }
            }
        }

        return $histogram;
    }
}

// HTML form handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $start = $_POST['start'];
    $finish = $_POST['finish'];

    $collatzStats = new CollatzStatistics($start);
    $histogram = $collatzStats->calculateStatistics($start, $finish);

    // Display histogram
    echo "<h2>Statistics (Histogram) for Collatz Conjecture Iterations:</h2>\n";
    echo "<table>\n";
    echo "<tr><th>Iterations</th><th>Frequency</th></tr>\n";
    foreach ($histogram as $iterations => $frequency) {
        echo "<tr><td>$iterations</td><td>$frequency</td></tr>\n";
    }
    echo "</table>\n";

    // Draw histogram
    echo '<h3>Graphical Representation:</h3>';
    echo '<div class="bar-graph" style="font-size: 10px;">';
    foreach ($histogram as $iterations => $frequency) {
        echo '<div class="bar" style="width: ' . ($frequency * 5) . 'px; height: 20px; background-color: black; margin-bottom: 5px;"></div>';
        echo '<div class="frequency" style="color: black;">' . $frequency . '</div>';
    }
    echo '</div>';
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Collatz Conjecture Calculator</title>
</head>
<body>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    Start: <input type="text" name="start"><br><br>
    Finish: <input type="text" name="finish"><br><br>
    <input type="submit" name="submit" value="Calculate">
</form>

</body>
</html>
