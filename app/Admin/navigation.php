<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\User::class)->setTitle('test')->setPages(function(Page $page) {
// 	  $page
//		  ->addPage()
//	  	  ->setTitle('Dashboard')
//		  ->setUrl(route('admin.dashboard'))
//		  ->setPriority(100);
//
//	  $page->addPage(\App\User::class);
// });
//
// // or
//
// AdminSection::addMenuPage(\App\User::class)

return [
	[
		'title' => "Activities",
		'priority' => 0,
		'icon'  => 'fa fa-tree',
		'model' => \App\Activity::class
	],
	[
		'title'    => "Agencies",
		'priority' => 1,
		'icon'     => 'fa fa-university',
		'pages' => [
			(new Page(\App\Agency::class))
				->setIcon('fa fa-tree')
				->setPriority(0),
			[
				'title' => 'Send emails',
				'priority' => 1,
				'icon'  => 'fa fa-envelope-o',
				'url'   => action('AgencyEmailsController@viewList')
			]
		]
	],
	[
		'title' => "Offers",
		'priority' => 2,
		'icon'  => 'fa fa-star',
		'model' => \App\Offer::class
	],
	[
		'title' => "Reservations",
		'priority' => 3,
		'icon'  => 'fa fa-handshake-o',
		'model' => \App\Reservation::class
	],
	[
		'title' => "Emails",
		'priority' => 4,
		'icon'  => 'fa fa-envelope-o',
		'model' => \App\Reservation::class
	],
	[
		'title' => "Guide activities",
		'priority' => 5,
		'icon'  => 'fa fa-map-marker',
		'model' => \App\FreeActivity::class
	],
	[
		'title' => "Reservations",
		'priority' => 6,
		'icon'  => 'fa fa-handshake-o',
		'model' => \App\Reservation::class
	],
	[
		'title' => "Suggestions",
		'priority' => 7,
		'icon'  => 'fa fa-thumbs-up',
		'model' => \App\Suggestion::class
	],
	[
		'title' => "Users",
		'priority' => 100,
		'icon'  => 'fa fa-users',
		'model' => \App\User::class
	],
	[
		'title' => "Roles",
		'priority' => 101,
		'icon'  => 'fa fa-graduation-cap',
		'model' => \App\Role::class
	],
	[
		'title' => "Permissions",
		'priority' => 102,
		'icon'  => 'fa fa-key',
		'model' => \App\Permission::class
	],
	
	// Examples
	// [
	//    'title' => 'Content',
	//    'pages' => [
	//
	//        \App\User::class,
	//
	//        // or
	//
	//        (new Page(\App\User::class))
	//            ->setPriority(100)
	//            ->setIcon('fa fa-user')
	//            ->setUrl('users')
	//            ->setAccessLogic(function (Page $page) {
	//                return auth()->user()->isSuperAdmin();
	//            }),
	//
	//        // or
	//
	//        new Page([
	//            'title'    => 'News',
	//            'priority' => 200,
	//            'model'    => \App\News::class
	//        ]),
	//
	//        // or
	//        (new Page(/* ... */))->setPages(function (Page $page) {
	//            $page->addPage([
	//                'title'    => 'Blog',
	//                'priority' => 100,
	//                'model'    => \App\Blog::class
	//		      ));
	//
	//		      $page->addPage(\App\Blog::class);
	//	      }),
	//
	//        // or
	//
	//        [
	//            'title'       => 'News',
	//            'priority'    => 300,
	//            'accessLogic' => function ($page) {
	//                return $page->isActive();
	//		      },
	//            'pages'       => [
	//
	//                // ...
	//
	//            ]
	//        ]
	//    ]
	// ]
];