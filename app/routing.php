<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [

    'Admin' => [ // Controller
        ['index', '/admin', 'GET'], // action, url, method
    ],
    'Home' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
        ['presentation', '/presentation', 'GET'],
        ['productsByOneCategory', '/category/{id:\d}', 'GET'],
        ['contact', '/contact', 'GET'],
    ],
    'Category' => [ // Controller
        ['add', '/admin/category/add', ['GET', 'POST']],// action, url, method
        ['index', '/admin/category/index', 'GET'],// action, url, method

    ],

    'Product' => [ // Controller

        ['index', '/admin/product/index', 'GET'], // action, url, method
        ['delete', '/admin/product/index', 'POST'], // action, url, method
    ],

    'Brand' => [ // Controller
        ['add', '/admin/brand/add', ['GET', 'POST']], // action, url, method
        ['index', '/admin/brand', ['GET']], // action, url, method
        ['highlightedBrands', '/admin/brand/highlighted/{id:\d+}', ['GET', 'POST']],//action, url, method

    ],
];

