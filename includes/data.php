<?php

// This file contains dummy data for development purposes.
// In a real application, this data would come from a database.

$poster_urls = [
    'https://i.postimg.cc/3WZd5Xsk/f1.jpg',
    'https://i.postimg.cc/BXQtq83M/f10.jpg',
    'https://i.postimg.cc/rKnsz8Fc/f2.jpg',
    'https://i.postimg.cc/PCCxwBPD/f3.jpg',
    'https://i.postimg.cc/v4CmL3VN/f4.jpg',
    'https://i.postimg.cc/jWNS8P6d/f5.jpg',
    'https://i.postimg.cc/qhxMrrZP/f6.jpg',
    'https://i.postimg.cc/wypTnMF5/f7.jpg',
    'https://i.postimg.cc/WqppbyBh/f8.jpg',
    'https://i.postimg.cc/K4m8NK1x/f9.jpg',
];

$homepage_carousel_posters = array_slice($poster_urls, 0, 5);

$upcoming_projects = [
    [
        'id' => 1,
        'title' => 'Kabali',
        'cast' => 'Rajinikanth, Radhika Apte',
        'poster_path' => $poster_urls[0],
        'hot_deal_snippet' => '🎬 Hot Deal from Velan Productions (WEB) 🔥 Limited Ticket Size – Grab Yours Before It’s Gone!',
        'returns' => '5% – 10%',
        'tenure' => '3 Months',
        'min_investment' => '₹50,000',
        'asset_fee' => '₹140'
    ],
    [
        'id' => 2,
        'title' => 'Vikram',
        'cast' => 'Kamal Haasan, Vijay Sethupathi',
        'poster_path' => $poster_urls[2],
        'hot_deal_snippet' => '🎬 Hot Deal from Pixel Studios (OTT) 🔥 Filling Fast!',
        'returns' => '6% – 12%',
        'tenure' => '4 Months',
        'min_investment' => '₹75,000',
        'asset_fee' => '₹160'
    ],
    [
        'id' => 3,
        'title' => 'Leo',
        'cast' => 'Vijay, Trisha Krishnan',
        'poster_path' => $poster_urls[3],
        'hot_deal_snippet' => '🎬 Exclusive Deal from Cinema Magic (WEB) 🔥 Last Few Seats!',
        'returns' => '7% – 11%',
        'tenure' => '2 Months',
        'min_investment' => '₹1,00,000',
        'asset_fee' => '₹200'
    ]
];

// The trailers page shows posters of recent movies.
// The prompt doesn't ask for investment info here, just the snippet.
$latest_trailers = [
    [
        'id' => 1,
        'title' => 'Jailer',
        'poster_path' => $poster_urls[4],
        'snippet' => '🎬 Hot Deal from Velan Productions (WEB) 🔥 Limited Ticket Size – Grab Yours Before It’s Gone!'
    ],
    [
        'id' => 2,
        'title' => 'Ponniyin Selvan: I',
        'poster_path' => $poster_urls[5],
        'snippet' => '🎬 Hot Deal from Pixel Studios (OTT) 🔥 Filling Fast!'
    ],
    [
        'id' => 3,
        'title' => 'Master',
        'poster_path' => $poster_urls[6],
        'snippet' => '🎬 Hot Deal from Velan Productions (WEB) 🔥 Limited Ticket Size – Grab Yours Before It’s Gone!'
    ]
];
