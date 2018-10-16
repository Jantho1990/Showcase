<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Table Prefix
    |--------------------------------------------------------------------------
    |
    | This will add a prefix to all Showcase-related tables. This is useful if
    | you have existing, conflicting table names.
    */
    'table_prefix' => 'showcase_',

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | An array of existing application middleware you'd like Showcase routes to
    | pass through. This is required to use Showcase behind authentication.
    */
    'middleware' => ['web', 'auth'],

    /*
    |--------------------------------------------------------------------------
    | Description Length
    |--------------------------------------------------------------------------
    |
    | Change the trophy description length maximum.
    */
    'description_length' => 55,

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | Sets the prefix for Showcase routes.
    */
    'route_prefix' => 'showcase',
];
