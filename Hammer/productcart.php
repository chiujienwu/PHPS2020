<?php
//probably would want to put this in the index assuming the two assignments are related but not required
//since requirements are not specified on when this cart check out would relate to the previous assignment
session_name('jchiu_week03hw');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hammer Time</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500|Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="hcalc.css">
    <script src="hcalc.js"></script>
</head>
<body>
<div class="container">
    <h1>Rick Hammer's Store</h1>
    <hr>
    <div class="row">
        <div class="col-sm-6 col-md-8">
            <h3>Products</h3>
            <div class="card-columns">
<?php
// check for previous cart in session
$_SESSION['cart'] = $_SESSION['cart'] ?? [];
$_SESSION['salesTaxRate'] = $_SESSION['salesTaxRate'] ?? 0.05;
$_SESSION['cartTotal'] = $_SESSION['cartTotal'] ?? 0.00;
$_SESSION['taxAmount'] = $_SESSION['taxAmount'] ?? 0.00;

// check for previous items and declare global variables
$name = isset($_POST['name']) ? $_POST['name'] : "[none]";
$price = isset($_POST['price']) ? $_POST['price'] : "[none]";

//assignment given
$products = array(
    array(	'name' => 'Drawer Pull',
        'price' => 3.99,
        'image' => 'https://farm3.staticflickr.com/2165/2246272794_7328992509_b.jpg',
        'description' => 'Antique bronze drawer pull. Adds character to your desk drawers.'),
    array(	'name' => 'Drawer Organizer',
        'price' => 17.99,
        'image' => 'https://images-na.ssl-images-amazon.com/images/I/91tlrCudmyL._SX679_.jpg',
        'description' => 'Bamboo wood adjustable drawer organizer with 6 removable dividers.'),
    array(	'name' => 'Pencil Holder',
        'price' => '9.95',
        'image' => 'https://images-na.ssl-images-amazon.com/images/I/51V2aMxGrYL._SX679_.jpg',
        'description' => ' Bamboo wood desk pen/pencil holder. Size: 3" L x 3" W x 4" H.'),
    array(	'name' => 'Desk Lamp',
        'price' => 24.95,
        'image' => 'https://images-na.ssl-images-amazon.com/images/I/61u9oOHCKAL._SX679_.jpg',
        'description' => 'Swing arm is easily adjustable to direct the light wherever you need it.')
);
//code checking:
//$temp = $products[3]['image'];
//echo '<img class="card-img-top" src=' . $temp . ' alt="test">';

foreach ($products as $p)
    {
        echo '<div class="card">';
        echo '<img class="card-img-top" src=' . $p['image'] . ' alt=' . $p['name'] . '>';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $p['name'] . '</h5>';
        echo '<p><b>' . $p['price'] . '</b></p>';
        echo '<p class="card-text">' . $p['description'] . '</p>';
        echo '<form method="post">';
        echo '<input type="hidden" name="name" value=' . $p['name'] . '>';
        echo '<input type="hidden" name="price" value=' . $p['price'] . '>';
        echo '<button type="submit" name="submit" value="Submit" class="btn btn-primary">Add to Cart</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';

        //code checking:
        //echo $p['image'] . '</br>';
    }
?>
            </div>
        </div>
        <div class="col-sm-6 col-md-4 cart">
            <h3>Cart</h3>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-right">Price</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // TODO enter submit button behavior here
                // add order to array
                if(isset($_POST['submit'])) {
                    $_SESSION['cart'][] = [
                        'name' => $name,
                        'price' => $price];
                    $_SESSION['cartTotal'] = $_SESSION['cartTotal'] + $price;
                    $_SESSION['taxAmount'] = $_SESSION['cartTotal'] * $_SESSION['salesTaxRate'];
                }

                // make sure cart exists and is not empty
                if(isset($_SESSION['cart']) and !empty($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $order) {
                        echo "<tr>
                                <td>{$order['name']}</td>
                                <td>{$order['price']}</td>
                                </tr>";
                    }
                    echo '<th class="text-right">Subtotal: <br>';
                    echo 'Tax: <br>';
                    echo 'Total:';
                    echo '</th>';
                    echo '<th class="text-right">$' . $_SESSION['cartTotal'] . '<br>';
                    echo '$' . $_SESSION['taxAmount'] . '<br>';
                    echo '$' . ($_SESSION['cartTotal'] + $_SESSION['taxAmount']) . '<br>';
                    echo '</th>';
                }
                ?>
                <form method="post">
                    <button name="reset" type="submit" class="btn btn-secondary">Reset</button>
                </form>
                </tr>
                </tbody>
                <tfoot>
                </tfoot>
                </table>
        </div>
        </div>
</div>

</body>
</html>
