<?php
    // session name to keep the php session unique to this project
    session_name('tkowalch_week3');

    // start the session before any HTML or echo is sent
    session_start();

    // session_start gives us the superglobal $_SESSION
    // store something in the session
    // if(isset($_POST['login'])....
    $_SESSION['username'] = 'Tyler';

    // create session variable, use existing value if available, set to zero if not available
    $_SESSION['visits'] = $_SESSION['visits'] ?? 0;
    $_SESSION['visits']++;

    // debug session
    var_dump($_SESSION);

    // destroy session (used for logout)
    // clears session when the page finishes loading
    //session_destroy();

    // remove specific value
    unset($_SESSION['username']);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .error {color: red; font-weight: bold;}
    </style>
</head>
<body>
<?php

    // get values previously submitted, and specify default value
    $name = isset($_POST['name']) ? $_POST['name'] : ''; //'' is the default value
    $name = $_POST['name'] ?? ''; // same as previous line, but shorter
    $entree = $_POST['entree'] ?? '';
    $toppings = $_POST['toppings'] ?? [];
    
    // create variables for checked status of entree
    $hamburgerChecked = $entree == "hamburger" ? 'checked' : '';
    $pizzaChecked = $entree == "pizza" ? 'checked' : '';
    $saladChecked = $entree == "salad" ? 'checked' : '';

    // create variables for checked status of toppings
    $cheeseChecked = in_array("cheese", $toppings) ? 'checked' : '';
    $baconChecked = in_array("bacon", $toppings) ? 'checked' : '';
    $olivesChecked = in_array("olives", $toppings) ? 'checked' : '';

    // validate name field
    $formIsValid = true;
    $nameError = '';
    // only validate if the form was submitted
    if(isset($_POST['submit'])) {
        if (empty($name)) {
            $nameError = "Name is required.";
            $formIsValid = false;
        }

        if (strlen($name) < 3) {
            $nameError = "Name must be at least 3 characters.";
            $formIsValid = false;
        }

        if (is_numeric($name)) {
            $nameError = "Name cannot be a number.";
            $formIsValid = false;
        }
    }
?>
<form action="" method="post">
    <p>
        <label for="name">Name: <span class="error"><?= $nameError ?></span></label><br>
        <input type="text" name="name" id="name" value="<?= $name ?>">
        <!-- prepopulate value attribute to make form sticky -->
    </p>
    <p>
        <input type="radio" name="entree" id="hamburger" value="hamburger" <?= $hamburgerChecked ?> >
        <label for="hamburger">Hamburger</label>
    </p>
    <p>
        <input type="radio" name="entree" id="pizza" value="pizza" <?= $pizzaChecked ?> >
        <label for="pizza">Pizza</label>
    </p>
    <p>
        <input type="radio" name="entree" id="salad" value="salad" <?= $saladChecked ?> >
        <label for="salad">Salad</label>
    </p>
    <p>
        Toppings:<br>
        <label>
            <input type="checkbox" name="toppings[]" value="cheese" <?= $cheeseChecked ?> > Cheese
        </label>
        <label>
            <input type="checkbox" name="toppings[]" value="olives" <?= $olivesChecked ?> > Olives
        </label>
        <label>
            <input type="checkbox" name="toppings[]" value="bacon" <?= $baconChecked ?> > Bacon
        </label>
    </p>
    <p>
        <input type="submit" name="submit" value="Submit">
        <input type="submit" name="cancel" value="Cancel">
    </p>
</form>

<?php
    // values from the form will be in $_GET or $_POST
    // var_dump or print_r is used to debug output
    echo "<pre>";
    var_dump($_POST);
    print_r($_POST);
    echo "</pre>";

    //check if form was submitted
    //if(isset($_POST['name'])) {
    if(isset($_POST['submit']) && $formIsValid) {
        echo "<h3>Welcome " . $_POST['name'] . "!</h3>";

        // provide some default values if the user didn't choose one
        $entree = isset($_POST['entree']) ? $_POST['entree'] : "[none]";
        $toppings = isset($_POST['toppings']) ? $_POST['toppings'] : array();

        echo "Thanks for your order of $entree with the following toppings: "
            . implode(", ", $toppings);

        // add order to the cart
        // create empty cart array if it doesn't exist
        $_SESSION['cart'] = $_SESSION['cart'] ?? [];

        // add order to array
        $_SESSION['cart'][] = [
                                'name' => $name,
                                'entree' => $entree,
                                'toppings' => $toppings
                                ];

        //echo $_SESSION['cart'][2]['toppings'][1];
    }



?>
<hr>
<h3>Orders</h3>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Entree</th>
            <th>Toppings</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // make sure cart exists and is not empty
        if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $order){
                echo "<tr>
                        <td>{$order['name']}</td>
                        <td>{$order['entree']}</td>
                        <td>" . implode(', ', $order['toppings']) ."</td>
                    </tr>";
            }
        }
    ?>
    </tbody>
</table>

<?php
// initialize session variable to keep track of current order
// use previous value or zero if it doesn't exist
$_SESSION['current'] = $_SESSION['current'] ?? 0;

// if next button was clicked
if(isset($_POST['next'])) {
    // increment current song
    $_SESSION['current']++;

    // limit to last order to prevent "out of bounds" error
    if($_SESSION['current'] >= count($_SESSION['cart'])){
        $_SESSION['current'] = count($_SESSION['cart']) - 1;
    }
}

// (same for previous)
if(isset($_POST['previous'])) {
    $_SESSION['current']--;

    if($_SESSION['current'] < 0){
        $_SESSION['current'] = 0;
    }
}

// use the current "index" to output a specific order
$current = $_SESSION['current'];
echo $_SESSION['cart'][$current]['name']
    . ' ordered ' . $_SESSION['cart'][$current]['entree'];
?>

<!-- separate form to keep the other fields
     in the other form from posting -->
<form method="post">
    <input type="submit" name="next" value="Next">
    <input type="submit" name="previous" value="Previous" <?= $_SESSION['current'] == 0 ? 'disabled' : ''?> >
</form>

</body>
</html>
