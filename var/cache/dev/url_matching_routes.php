<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/companies' => [[['_route' => 'api_get_companies', '_controller' => 'App\\Controller\\CompanyController::getCompanies'], null, ['GET' => 0], null, false, false, null]],
        '/api/company-create' => [[['_route' => 'api_create_company', '_controller' => 'App\\Controller\\CompanyController::createCompany'], null, ['POST' => 0], null, false, false, null]],
        '/api/company-edit' => [[['_route' => 'api_edit_company', '_controller' => 'App\\Controller\\CompanyController::editCompany'], null, ['PUT' => 0], null, false, false, null]],
        '/api/company-delete' => [[['_route' => 'api_company_delete', '_controller' => 'App\\Controller\\CompanyController::deleteCompany'], null, ['POST' => 0], null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/api/company/([^/]++)(*:63)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        63 => [
            [['_route' => 'api_get_company', '_controller' => 'App\\Controller\\CompanyController::getCompany'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
