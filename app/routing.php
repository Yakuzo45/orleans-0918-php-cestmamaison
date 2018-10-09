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
        ['index', '/', 'GET'], // action, url, method
    ],
    'Category' => [ // Controller
        ['index', '/category', 'GET'], // action, url, method
        ['add', '/category/add', ['GET', 'POST']], // action, url, method
        ['edit', '/category/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['show', '/category/{id:\d+}', 'GET'], // action, url, method
        ['delete', '/category/delete/{id:\d+}', 'GET'], // action, url, method
    ],

];
