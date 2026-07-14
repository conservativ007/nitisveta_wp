<?php

require dirname(__DIR__) . '/theme/inc/cities.php';

$cities = [
    ['name' => 'Москва', 'population' => 13000000, 'isDualName' => false],
    ['name' => 'Московский', 'population' => 27000, 'isDualName' => false],
    ['name' => 'Казань', 'population' => 1300000, 'isDualName' => false],
];

assert(array_column(nitisveta_search_russia_cities($cities, 'мос'), 'id') === ['Москва', 'Московский']);
assert(array_column(nitisveta_search_russia_cities($cities, '', 2), 'id') === ['Москва', 'Казань']);

echo "cities search: OK\n";
