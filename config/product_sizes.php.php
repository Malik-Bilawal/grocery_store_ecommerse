<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Size Display Mapping
    |--------------------------------------------------------------------------
    |
    | Here we map the database value (in Kg) to the display value (in Grams).
    | Ensure keys are strings formatted to 2 decimal places usually.
    |
    */

    'map' => [
        '0.05' => '50g',
        '0.25' => '250G',
        '0.50' => '500G',
        '0.75' => '750G',
        '1.00' => '1000G',
        '1.50' => '1500G',
        '3.00' => '3000G',
        '5.00' => '5000G',
    ],

    // Fallback unit if key is not found in the map above
    'default_unit' => 'g', 
];