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
    ],
    'Category' => [ // Controller
        ['add', '/admin/category/add', ['GET', 'POST']], // action, url, method
    ],

    'Brand' => [ // Controller
        ['add', '/admin/brand/add', ['GET', 'POST']], // action, url, method
        ['index', '/admin/brand', ['GET','POST']], // action, url, method
        ],
];
