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
    'Category' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
        ['add', '/category/add', ['GET', 'POST']], // action, url, method
        ['edit', '/category/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['show', '/category/{id:\d+}', 'GET'], // action, url, method
        ['delete', '/category/delete/{id:\d+}', 'GET'], // action, url, method
    ],
    'Brands' => [ // Controller
        ['index', '/brands', 'GET'], // action, url, method
        ['add', '/brands/add', ['GET', 'POST']], // action, url, method
        ['edit', '/brands/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['show', '/brands/{id:\d+}', 'GET'], // action, url, method
        ['delete', '/brands/delete/{id:\d+}', 'GET'], // action, url, method
    ],
    'Products' => [ // Controller
        ['index', '/products', 'GET'], // action, url, method
        ['add', '/products/add', ['GET', 'POST']], // action, url, method
        ['edit', '/products/edit/{id:\d+}', ['GET', 'POST']], // action, url, method
        ['show', '/products/{id:\d+}', 'GET'], // action, url, method
        ['delete', '/products/delete/{id:\d+}', 'GET'], // action, url, method
    ],
];
