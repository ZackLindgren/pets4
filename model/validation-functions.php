<?php

function validForm1()
{
    global $f3;
    $isValid= true;



    if (!validString($f3->get('animal'))) {
        $isValid = false;
        $f3->set("errors['animal']", "Please enter an animal ");
    }
    if (!validQty($f3->get('qty'))) {
        $isValid = false;
        $f3->set("errors['qty']", "Please enter 1 or more");



    }
    return $isValid;
}


function validColor($color)
{
    global $f3;
    return in_array($color,$f3->get('colors'));
}

function validString($string)
{
    return $string !== "" && ctype_alpha($string);
}

function validQty($qty)
{
    return ctype_digit($qty) && $qty > 0;
}