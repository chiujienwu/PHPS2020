<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        .error {color: red; font-eight: bold;}
    </style>
    <title>My Handy Calculator</title>
</head>
<h1>Welcome to My Simple PHP Calculator!</h1>

<?php
/* creating stickiness */
$operand1 = $_POST['operand1'] ?? 0;
$operand2 = isset($_POST['operand2']) ? $_POST['operand2'] : 0;

$operator = isset($_POST['operator']) ? $_POST['operator'] : '';

// create variables for checked status of operator (radio buttons)
$additionChecked = $operator == "addition" ? 'checked' : '';
$subtractionChecked = $operator == "subtraction" ? 'checked' : '';
$multiplicationChecked = $operator == "multiplication" ? 'checked' : '';
$divisionChecked = $operator == "division" ? 'checked' : '';

/* validation of inputs before performing math operations */
$operandError = '';
$operatorError = '';
$formIsValid = true;

if (isset($_POST['submit'])) {

    if (empty($operand1) or empty($operand2)) {
        $operandError = "Both operands are required.";
        $formIsValid = false;
    }

    if (!is_numeric($operand1) and !is_numeric($operand2)) {
        $operandError = "Both operands must be numbers.";
        $formIsValid = false;
    }

    if (empty($operator)) {
        $operatorError = "An operation must be selected.";
        $formIsValid = false;
    }
}

?>

<body>
    <form action="" method="post">

        <!--start of operands entry-->
        <label for="operand1">Operand 1: <span class="error"><?= $operandError ?></span></label>
        <input type="number" name="operand1" id="operand1" value="<?= $operand1 ?>"><br>

        <label for="operand2">Operand 2: <span class="error"><?= $operandError ?></span></label>
        <input type="number" name="operand2" id="operand2" value="<?= $operand2 ?>"><br>

        <!--start of radio button for calculator operation-->
        <input type="radio" name="operator" id="addition" value="addition" <?= $additionChecked ?> >
        <label for="addition">Add</label>
        <input type="radio" name="operator" id="subtraction" value="subtraction" <?= $subtractionChecked ?> >
        <label for="subtraction">Subtract</label>
        <input type="radio" name="operator" id="multiplication" value="multiplication" <?= $multiplicationChecked ?> >
        <label for="multiplication">Multiply</label>
        <input type="radio" name="operator" id="division" value="division" <?= $divisionChecked ?> >
        <label for="division">Divide</label>

        <p>
            <input type="submit" name="submit" value="Submit">
        </p>

    </form>

    <?php
    echo "<pre>";
    echo "This is var_dump:";
    var_dump($_POST);
    echo "This is print_r:";
    print_r($_POST);
    echo "</pre>";

    if (isset($_POST['submit']) and $formIsValid) {

        /* after validation of inputs perform specified operation and output results*/

        if ($operator == 'addition') {
            $result = $operand1 + $operand2;
        } elseif ($operator == 'subtraction') {
            $result = $operand1 - $operand2;
        } elseif ($operator == 'multiplication') {
            $result = $operand1 * $operand2;
        } elseif ($operator == 'division') {
            if ($operand2 == 0) {
                echo "Cannot divide by zero!";
            } else {
                $result = $operand1 / $operand2;
            }
        } else {
            echo "Something went wrong!  ";
        }

        echo "The result of your submit is : " . number_format($result,2);

    }
    ?>

</body>
</html>
