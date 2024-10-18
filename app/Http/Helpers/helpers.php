<?php

function number($number)
{
    return number_format($number, 0, '.', ',');
}

function currency($number)
{
    return '$' . number($number);
}
