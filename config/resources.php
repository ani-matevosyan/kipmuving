<?php

return [
    'home' => [
        'styles' => [
          'css/home.css'
        ],
        'scripts' => [
          'js/home.js'
        ]
    ],


    'sendOffer' => [
        'styles' => [
            'css/send-offer-style.css'
        ],
        'scripts' => [
            'js/send-offer-scripts.js'
        ]
    ],


    'user' => [
        'account' => [
            'styles' => [
                'css/user-account.css'
            ],
            'scripts' => [
                'js/user-account.js'
            ]
        ],
        'reservations' => [
            'styles' => [
                'css/user-reservations.css'
            ],
            'scripts' => [
                'js/user-reservations.js'
            ]
        ]
    ],


    'reservation' => [
        'styles' => [
          'css/reservation-style.css',
        ],
        'scripts' => [
          'js/reservation-scripts.js'
        ]
    ],


    'guide' => [
        'styles' => [
          'css/guide-style.css'
        ],
        'scripts' => [
          'js/guide-scripts.js'
        ]
    ],


  'free' => [

    'walking' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js'
      ]
    ],

    'bicycle' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js'
      ]
    ],

    'bus' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js',
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps'
        ]
      ]
    ],

    'cultural' => [
      'styles' => [
        'css/free-style.css'
      ],
      'scripts' => [
        'js/free-pages-scripts.js',
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initGuideMaps'
        ]
      ]
    ]
  ],


  'calendar' => [
    'styles' => [
      'css/calendar-style.css'
    ],
    'scripts' => [
      'js/calendarpage-scripts.js'
    ]
  ],


  'agencies' => [

    'single' => [
      'styles' => [
        'css/agencies.css'
      ],
      'scripts' => [
        [
          'link' =>  'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initAgencyMap'
        ],
        'js/agencies.js',
      ]
    ],

    'list' => [
      'styles' => [
        'css/agencies.css'
      ],
      'scripts' => [
        'js/agencies.js',
      ]
    ]
  ],


  'activities' => [

    'single' => [
      'styles' => [
        'css/activity.css'
      ],
      'scripts' => [
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap'
        ],
        'js/activity.js'
      ]
    ],

    'list' => [
      'styles' => [
        'css/activities.css'
      ],
      'scripts' => [
        'js/activities.js'
      ]
    ]
  ],

  'about' => [
    'styles' => [
      'css/about-style.css'
    ]
  ],

  'login' => [
    'styles' => [

    ],
    'scripts' => [

    ]
  ],

  'register' => [
    'styles' => [

    ],
    'scripts' => [

    ]
  ],

  'routes' => [
    'styles' => [
      'css/routes.css'
    ],
    'scripts' => [
      'home' => [
        'js/routes.js'
      ],
      'single' => [
        [
          'link' => 'https://maps.google.com/maps/api/js?key=AIzaSyBED1xxwdz2aeMSXBDtJwItnDn7apYZjF8&callback=initMap'
        ],
        'js/routes.js'
      ]
    ]
  ]
];