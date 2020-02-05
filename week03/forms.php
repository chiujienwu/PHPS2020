<?php
    // session name to keep the php session unique to this project
    // if session is created in error, may need to delete the cookie
    session_name('jchiu_week03');

    // start the session before any HTML or echo is sent include space
    session_start();

    // session_start gives us the superglobal $_SESSION accessible anywhere in your PHP code and has no scope restrictions
    // store something in the session
    // if(isset($_POST['login']).... typically would start the web session
    $_SESSION['username'] = 'Tyler';

    // create session variable visits, use existing value if available, else set to zero if not available
    $_SESSION['visits'] = $_SESSION['visits'] ?? 0;
    $_SESSION['visits']++;

    // debug session
    var_dump($_SESSION);

    // destroy session (used for logout)
    // session_destroy();

    // remove specific value from the session array
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
        .error {color: red; font-eight: bold;}
    </style>
</head>
<body>

<?php
    // get values previously submitted, and specify default value
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $name = $_POST['name'] ?? '';  // same as previous line but shorter

    $entree = $_POST['entree'] ?? '';
    $toppings = $_POST['toppings'] ?? [];

    // create variables for checked status of entree (radio buttons)
    $hamburgerChecked = $entree == "hamburger" ? 'checked' : '';
    $pizzaChecked = $entree == "pizza" ? 'checked' : '';
    $saladChecked = $entree == "salad" ? 'checked' : '';

    // create variables for checked status of toppings (check boxes)
    $cheeseChecked = in_array("cheese", $toppings) ? 'checked' : '';
    $baconChecked = in_array("bacon", $toppings) ? 'checked' : '';
    $olivesChecked = in_array("olives", $toppings) ? 'checked' : '';

    // validate name field
    $formIsValid = true;
    $nameError = '';
    // only validate if the form was submitted
    if(isset($_POST['submit'])){

        if(empty($name)){
            $nameError = "Name is required.";
            $formIsValid = false;
        }

        if(strlen($name) < 3){
            $nameError = "Name must be at least 3 characters.";
            $formIsValid = false;
        }

        if(is_numeric($name)){
            $nameError = "Name cannot be a number.";
            $formIsValid = false;
        }
    }

?>

<form action="" method="post">
    <!--ends to server without embedding data values in the url as oppose to get-->
    <!--leaving action blank for now but one can send to another file-->
    <p>
        <label for="name">Name: <span class="error"><?= $nameError ?></span></label><br>
        <!--        for references next input with ID = name-->
        <!-- '?=' is short for '?php echo'-->
        <input type="text" name="name" id="name" value="<?= $name ?>">
        <!--        PHP only cares about the name attribute and not the ID attribute-->
        <!--  prepopulate value attribute to make form sticky -->
    </p>

    <p>
        <input type="radio" name="entree" id="hamburger" value="hamburger" <?= $hamburgerChecked ?>>
        <label for="hamburger">Hamburger</label>
    </p>

    <p>
        <input type="radio" name="entree" id="pizza" value="pizza" <?= $pizzaChecked ?>>
        <label for="pizza">Pizza</label>
    </p>

    <p>
        <input type="radio" name="entree" id="salad" value="salad" <?= $saladChecked ?>>
        <label for="salad">Salad</label>
    </p>

    <p>
        Toppings:<br>
        <label>
            <input type="checkbox" name="toppings[]" value="cheese" <?= $cheeseChecked ?> > Cheese
        </label>
        <label>
            <input type="checkbox" name="toppings[]" value="olives" <?= in_array("olives", $toppings) ? 'checked' : '' ?> > Olives
        </label>
        <label>
            <input type="checkbox" name="toppings[]" value="bacon" <?= $baconChecked ?> > Bacon
        </label>

    </p>

    <p>
        <input type="submit" name="submit" value="Submit">
    </p>
</form>

<?php
// values from the form will be in $_GET or $_POST
// var_dump or print_r
echo "<pre>";  // research this more
echo "This is var_dump:";
var_dump($_POST);
echo "This is print_r:";
print_r($_POST);
echo "</pre>";

//check if form was submitted
//if (isset($_POST['name'])) {

if (isset($_POST['submit']) and $formIsValid) {
    echo "Welcome " . $_POST['name'] . "!  </h3>";

    $entree = isset($_POST['entree']) ? $_POST['entree'] : "[none]";
    $toppings = isset($_POST['toppings']) ? $_POST['toppings'] : array();

    echo "Thanks for your order of $entree with the following toppings: "
        . implode(", ", $toppings);

    // add order to the cart if the form is valid
    // create empty cart array if it doesn't exist
    $_SESSION['cart'] = $_SESSION['cart']  ?? [];

    // add order to the array
    $_SESSION['cart'][] = [
        'name' => $name,
        'entree' => $entree,
        'toppings' => $toppings];

    // to display a topping of an order in an array of multiple orders
    echo $_SESSION['cart'][0][0]['toppings'][0];
};



?>
<!--<hr> is a horizontal rule tag-->
<hr>
<h3>Orders</h3>
<table>
    <thread>
        <th>Name</th>
        <th>Entree</th>
        <th>Toppings</th>
    </thread>
    <tbody>
    <?php
        // make sure cart exists and is not empty
        if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])){
            foreach($_SESSION['cart'] as $order) {
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

</body>
</html>
