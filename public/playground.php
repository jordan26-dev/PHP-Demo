<?php

use Illuminate\Support\Collection;

require __DIR__ .  '/../vendor/autoload.php';

$numbers = new Collection([
    1, 2, 3, 4, 5, 6, 7, 8, 9, 10
]);


// $numbers->contains(10) ?  die('it contains ten.') : die('it does not contain ten.');

$filteredNumbers = $numbers->filter(function ($numbers) {
    return $numbers >= 4 && $numbers <= 8; 
});

die(var_dump($filteredNumbers));