<?php

return [
    // Lifetime Rand in minutes
    'token-lifetimes' => [
        0  => [30, 60],         // View minutes
        10 => [150, 500],       // View hours
        20 => [1500, 5000],     // View days
        30 => [15000, 35000],   // View weeks
        40 => [60000, 129000],  // Quarterly
        50 => [130000, 260000], // Half year
        60 => [300000, 500000], // Max a year
    ],
];
