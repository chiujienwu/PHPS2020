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
<!--start of jumbotron-->
<div class="jumbotron">
    <h1 class="display-6">Welcome to Rick Hammer's Can't Touch This Wood Works</h1>
    <p class="lead">When you need the best desk for all your demanding computing and coding needs, you come to us!</p>
<!--    <hr class="my-4">-->
<!--    <p>Our time tested design and functionality,-->
<!--        along with our highly experienced craftmenship and selectiveness for the finest materials produces-->
<!--        some of the worlds most admired desks.-->
<!--    </p>-->
</div>
<!--end of jumbotron-->

<!--start form validation PHP-->
<!--When the form is submitted, the resulting page should validate the input and then display all the entered data and the final price of the desk.-->
<?php

// create variables for desk values and get previously submitted, or specify default values
$width = isset($_POST['width']) ? $_POST['width'] : 24;
$length = $_POST['length'] ?? 48;
$wood = $_POST['wood'] ?? 'pine';
$drawers = $_POST['drawers'] ?? 0;

// create variables for wood value and get previously submitted, or specify default value (radio buttons)
$mahoganyChecked = $wood == "mahogany" ? 'checked' : '';
$oakChecked = $wood == "oak" ? 'checked' : '';
$pineChecked = $wood == "pine" ? 'checked' : '';

// validate length and width fields
$formIsValid = true;
$lengthError = '';
$widthError = '';
$woodError = '';
$drawersError = '';

// only validate if the form was submitted
if(isset($_POST['submit'])){

    if(empty($length)){
        $lengthError = " is required.";
        $formIsValid = false;
    }

    if(!is_numeric($length)){
        $lengthError = " Length must be a number.";
        $formIsValid = false;
    }

    if(!($length >= 48 && $width <=72)){
        $lengthError = " Width must be a number between 0 and 3.";
        $formIsValid = false;
    }

    if(empty($width)){
        $widthError = " is required.";
        $formIsValid = false;
    }

    if(!is_numeric($width)){
        $widthError = " Width must be a number.";
        $formIsValid = false;
    }

    if(!($width >= 24 && $width <=48)){
        $widthError = " Width must be a number between 0 and 3.";
        $formIsValid = false;
    }

    if(empty($drawers)){
        $drawersError = " is required.";
        $formIsValid = false;
    }

    if(!is_numeric($drawers)){
        $drawers = " Drawers must be a number.";
        $formIsValid = false;
    }

    if(!($drawers >= 0 && $drawers <=3)){
        $drawersError = " Drawers must be a number between 0 and 3.";
        $formIsValid = false;
    }
}

?>
<!--end form validation PHP-->

<!--start of accordion form-->
<form action="" method="post">
<div class="container">
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="accordion mt-5" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="clearfix mb-0">
                            <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><i class="material-icons">add</i> Step 1 - Base Desk</a>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="media">
                                <img src="justlegs.png" class="mr-3" alt="table">
                                <div class="media-body">
                                    <h5 class="mt-0">Build your custom desk</h5>
                                    <p>Welcome to Rick Hammer's Custom Desk Shop!</p>
                                    <p>The base price for any desk with no drawer is $200</p>
                                    <p>This is the only way you can get my attention.</p>
                                    <p>Please proceed to Step 2 to provide dimensions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><i class="material-icons">add</i> Step 2 - Desktop</a>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="media">
                                <img src="desktop.png" class="mr-3" alt="desktop">
                                <div class="media-body">
                                    <h5 class="mt-0">Specify Dimension of Rectangular Desktop</h5>
                                    <p>How big of a desk do you need?</p>
                                    <p>Length (in inches with min length of 48 and max of 72)?</p>
                                    <label for="length">Length: <span class="error"><?= $lengthError ?></span></label><br>
                                    <input type="number" name="length" id="" value="<?= $length ?>" min="48" max="72">
                                    <p>Width (in inches with min width of 24 inches and max of 48)?</p>
                                    <label for="width">Width: <span class="error"><?= $widthError ?></span></label><br>
                                    <input type="number" name="width" id="" value="<?= $width ?>" min="24" max="48">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><i class="material-icons">add</i> Step 3 - Wood Material</a>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="media">
                                <img src="mahogany.png" class="mr-3" alt="tree">
                                <div class="media-body">
                                    <h5 class="mt-0">Pick your species of wood:</h5>
                                    <p>
                                        <input type="radio" name="wood" id="mahogany" value="mahogany" <?= $mahoganyChecked ?>>
                                        <label for="mahogany">Mahogany (additional $150 charge)</label>
                                    </p>

                                    <p>
                                        <input type="radio" name="wood" id="oak" value="oak" <?= $oakChecked ?>>
                                        <label for="oak">Oak (additional $125 charge)</label>
                                    </p>

                                    <p>
                                        <input type="radio" name="wood" id="pine" value="pine" <?= $pineChecked ?>>
                                        <label for="pine">Pine (price included in base $0 charge)</label>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2 class="mb-0">
                            <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour"><i class="material-icons">add</i> Step 4 - Drawers</a>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="media">
                                <img src="drawers.png" class="mr-3" alt="desk">
                                <div class="media-body">
                                    <h5 class="mt-0">How many drawers would you like to have?</h5>
                                    <label for="drawers">Number of drawers (min drawers = 0 and max is 3): <span class="error"><?= $drawersError ?></span></label><br>
                                        <input type="number" name="drawers" id="drawers" step="1" min="0" max="3">
                                    <div class="row">
                                        <div class="col-lg-1 offset-lg-6">
                                            <button type="submit" name="submit" id="submit" class="btn btn-outline-primary btn-lrg">Submit Desk Order</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</form>
<!--end of accordion form-->

<!--start of modal window-->

<!--start of desk order summary and cost calc PHP-->
<?php

$orderCost = 200;
$drawersCost = 0;
$surfaceArea = $length * $width;


if (isset($_POST['submit']) and $formIsValid) {

    if($wood == 'mahogany') {
        $orderCost  = $orderCost + 150;
    } elseif ($wood == 'oak') {
        $orderCost = $orderCost  + 125;
    }

    if($surfaceArea > 750) {
        $orderCost = $orderCost + 50;
    }

    $orderCost = $orderCost + ($drawers * 30);
};
?>

<?php
if(isset($_POST['submit']) and $formIsValid) {
    ?>
<script>
    $("#myModal").modal('show');
</script>
<?php
}
?>
// what happens when the modal window is closed?


?>
<!--end of desk order summary and calc-->

<div id="myModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>&times;</span></button>
                <h4 class="modal-title"><span>Thank you for your desk order!</span></h4>
            </div>
            <div class="modal-body">
                <?php
                    echo "<p>The desk will be made of {$wood}.</p>
                            <p>The dimensions will be {$length} inches in length, and</p>
                            <p>{$width} inches in width.</p>
                            <p>There will be {$drawers} number of drawers.</p>
                            <h4>The total cost of this order is $ {$orderCost}.</h4>";
                ?>
            </div>
        </div>
    </div>
</div>

<!--end of modal window-->

<?php
//if(isset($_POST['submit'])){
//    ?>
<!--<script>-->
<!--    $("#myModal").modal('show');-->
<!--    </script>-->
<?php
//}
//?>

</body>
</html>
