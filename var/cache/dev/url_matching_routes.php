<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/companies' => [[['_route' => 'api_get_companies', '_controller' => 'App\\Controller\\CompanyController::getCompanies'], null, ['GET' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/company/(?'
                    .'|([^/]++)(*:66)'
                    .'|create(*:79)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        66 => [[['_route' => 'api_get_company', '_controller' => 'App\\Controller\\CompanyController::getCompany'], ['id'], null, null, false, true, null]],
        79 => [
            [['_route' => 'api_create_company', '_controller' => 'App\\Controller\\CompanyController::createCompany'], [], ['POST' => 0], null, false, false, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
