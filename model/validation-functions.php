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

function validForm2()
{
    global $f3;
    $isValid= true;

    if (!validColor($f3->get('color'))) {
        $isValid = false;
        $f3->set("errors['colors']", "Please enter a valid color.");
    }
    if (!validToys($f3->get('toys'))) {
        $isValid = false;
        $f3->set("errors['toys']", "Please enter valid toys.");
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

function validToys($toys)
{
    global $f3;

    // Toys are optional
    if (empty($toys))
    {
        return true;
    }

    // check all checked boxes
    foreach($toys as $selection)
    {
        if(!in_array($selection, $f3->get('toys')))
        {
            return false;
        }
    }

    // all toys were good
    return true;
}