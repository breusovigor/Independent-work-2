<?php

return [
    'products/([a-zA-Z]+)/([a-zA-Z]+)' => 'products/detail/$2',
    'products/([a-zA-Z]+)' => 'products/index/$1',
    'products' => 'products/index',
    'contact' => 'contact/index',
    'catalog' => 'catalog/index',
    '^\s*$' => 'index/index',
];

?>