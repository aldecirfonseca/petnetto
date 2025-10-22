<?php

function getPagina()
{
    $aUri = explode("/", $_SERVER['REQUEST_URI']);

    if ($_SERVER['REQUEST_URI'] == "/") {
        return "home";
    } else {
        return $aUri[1];
    }
}