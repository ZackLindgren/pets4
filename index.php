<?php

session_start();
//Turn on error reporting
ini_set('display_errors', TRUE);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Create an instance of the Base class
$f3 = Base::instance();
$f3->set('colors', array('pink','green', 'blue'));
$f3->set('validToys', array('squeaky', 'bone', 'plushy', 'rope'));

// Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

// add the model
require_once('model/validation-functions.php');

//Define a default route
$f3 ->route('GET /', function()
{
    echo '<h1>My Pets</h1>';
    echo '<a href="order">Order a Pet</a>';
});

//define a route
$f3 ->route('GET /@animal', function($f3,$params)
{
    $animal= $params ['animal'];

    switch($animal)
    {
        case 'dog':
            echo "<h3> Woof!!</h3>";
            break;

        case 'chicken':
            echo "<h3> Cluck!</h3>";
            break;

        case 'cat':
            echo "<h3> Meow!</h3>";
            break;


        case 'snake':
            echo "<h3> Hiss!!</h3>";
            break;


        case 'pig':
            echo "<h3>Oink!</h3>";
            break;
        default:
            $f3->error(404);

    }

});

//define route  order 1
$f3->route('GET|POST /order', function ($f3)
{
    // clearing from previous sessions
    $_SESSION = array();

    if(!empty($_POST))
    {
        $animal = $_POST ["animal"];
        $qty = $_POST ["qty"];

        $f3->set('animal',$animal);
        $f3->set('qty',$qty);

        if(validForm1())
        {
            $_SESSION['animal'] = $animal;
            $_SESSION["qty"] = $qty;

            $f3->reroute("order2");
        }
    }

    $view=new Template();
    echo $view->render( 'views/form1.html');
});

//define route  order 2
$f3->route('GET|POST /order2', function ($f3)
{
    if (!empty($_POST))
    {
        $color = $_POST['color'];
        $toys = $_POST['toys'];

        $f3->set('color', $color);
        $f3->set('toys', $toys);

        if(validForm2())
        {
            $_SESSION['color'] = $color;
            $_SESSION['toys'] = $toys;

            $f3->reroute('/results');
        }
    }

    $view=new Template();
    echo $view->render( 'views/form2.html');
});

//define route  order 2
$f3->route('GET|POST /results', function ()
{
    $view=new Template();
    echo $view->render( 'views/results.html');
});

//Run fat free
$f3 ->run();