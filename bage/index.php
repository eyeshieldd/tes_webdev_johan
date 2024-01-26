<?php
session_start();

class ProgramLoop
{
    private $bageConcatCount = 0;

    public function run($i)
    {
        $output = '';


        if ($this->bageConcat($i)) {
            $output = "Bage Concat<br>";
            $this->bageConcatCount += 1;
        } elseif ($this->bage($i)) {
            if ($this->bageConcatCount >= 2) {
                $output = "Concat<br>";
            } else {
                $output = "Bage<br>";
            }
        } elseif ($this->concat($i)) {
            if ($this->bageConcatCount >= 2) {
                $output = "Bage<br>";
            } else {
                $output = "Concat<br>";
            }
        }
        if ($this->bageConcatCount >= 5) {
            $output = "Program Berhenti<br>";
        }



        return $output;
    }

    public function getBageConcatCount()
    {
        return $this->bageConcatCount;
    }

    private function bage($number)
    {
        return $number % 3 == 0;
    }

    private function concat($number)
    {
        return $number % 5 == 0;
    }

    private function bageConcat($number)
    {
        return $number % 3 == 0 && $number % 5 == 0;
    }

    public function reset()
    {
        $this->bageConcatCount = 0;
    }
}

if (!isset($_SESSION['program'])) {
    $_SESSION['program'] = new ProgramLoop();
}

$program = $_SESSION['program'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['reset'])) {
        $program->reset();
    } else {
        $loopCount = $_POST["loop_count"];
        $output = $program->run($loopCount);
        $bageConcatCount = $program->getBageConcatCount();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Program Loop</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input {
            padding: 8px;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }

        button[type="submit"] {
            background-color: #2196f3;
        }

        button:hover {
            background-color: #45a049;
        }

        #result {
            margin: 20px;
            font-weight: bold;
            font-size: 30px;
            color: red;
            font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;

        }
    </style>
</head>


<body>

    <form method="post" action="">
        <div id="result">
            <?php if (isset($output)) : ?>
                <?= $output ?>
            <?php endif; ?>
        </div>
        <label for="loop_count">Masukkan Angka:</label>

        <input type="text" name="loop_count" id="loop_count" placeholder="Masukan Angka">
        <button type="submit" name="run_program">Start</button>
        <button type="submit" name="reset">Reset</button>
    </form>

</body>

</html>