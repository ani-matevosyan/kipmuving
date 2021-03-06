<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\FreeActivity;

AdminSection::registerModel(FreeActivity::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();
	
	$model->setTitle('Free activities');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id', '#'),
			AdminColumn::text('page', 'Page')
				->append(
					AdminColumn::filter('region')
				),
			AdminColumn::text('region', 'Region')
				->append(
					AdminColumn::filter('region')
				),
			AdminColumn::text('name', 'Name'),
		]);
		$display->paginate(10);
		
		$display->setFilters(
			AdminDisplayFilter::related('region')
		);
		
		return $display;
	});
	
	$model->onEdit(function ($id) {
		
		$activity = FreeActivity::find($id);
		
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$warning_bus_est_time = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>120</small></div>';
		$warning_bus_est_exp = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>1500</small></div>';
		
		$guide_activity = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::text('name', 'Name')->required()
				], 6)
				->addColumn([
					AdminFormElement::select('category', 'Category')->required()->setOptions([
						'Visual'    => 'Visual',
						'Caminatas' => 'Caminatas',
						'Termas'    => 'Termas'
					])
				], 2)
				->addColumn([
					AdminFormElement::select('page', 'PAGE')->required()->setOptions([
						'walking'    => 'Walking',
						'bus'      => 'By car or bus',
						'cultural' => 'Cultural tour',
						'bicycle'  => 'Bicycle'
					])
				], 2)
				->addColumn([
					AdminFormElement::select('region', 'REGION')->required()->setOptions([
						'pucon'   => 'Pucon',
						'atacama' => 'Atacama',
                        'valparaiso' => 'Valparaiso',
                        'torresDelPaine' => 'Torres del Paine',
                        'santigo' => 'Santigo',
					])
				], 2),
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::text('instagram_id', 'Instagram tag')
				], 3)
				->addColumn([
					AdminFormElement::text('instagram_location_id', 'Instagram location ID')->required()
				], 3)
				->addColumn([
					AdminFormElement::text('latitude', 'Latitude')->required()
				], 3)
				->addColumn([
					AdminFormElement::text('longitude', 'Longitude')->required()
				], 3),
			AdminFormElement::text('short_description', 'Short description')->required(),
			AdminFormElement::textarea('description', 'Description')->required(),
			AdminFormElement::columns()
//					->addColumn([
//						AdminFormElement::textarea('real_time_ranges', 'Time')->required(),
//					], 8)
				->addColumn([
					AdminFormElement::image('image', 'Image'),
				], 12),
		]);
		
		$tripadvisor = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::textarea('tripadvisor_code', 'Tripadvisor code'),
		]);
		
		$route = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::textarea('route', 'Route (json)'),
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::text('real_bicycle_est_time', 'Est. time (in minutes)'),
					AdminFormElement::html($warning_bus_est_time),
				], 3)
				->addColumn([
					AdminFormElement::textarea('bicycle_description', 'Bicycle description'),
				], 9)
		]);
		
		$bus_data = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::html($warning_bus_est_time),
					AdminFormElement::text('real_bus_est_time', 'Est. time (in minutes)'),
				], 6)
				->addColumn([
					AdminFormElement::html($warning_bus_est_exp),
					AdminFormElement::text('bus_est_expenditure', 'Est. expenditure (per person)'),
				], 6),
//					->addColumn([
//						AdminFormElement::text('bus_est_service', 'Est. service (per person)'),
//					], 4),
			AdminFormElement::textarea('bus_description', 'Description'),
		]);
		
		if ($activity->page === 'cultural') {
			$tabs = AdminDisplay::tabbed([
				'Guide activity' => $guide_activity,
				'Tripadvisor'    => $tripadvisor
			]);
		} elseif ($activity->page === 'bicycle') {
			$tabs = AdminDisplay::tabbed([
				'Guide activity' => $guide_activity,
				'Tripadvisor'    => $tripadvisor,
				'Route'          => $route
			]);
		} else {
			$tabs = AdminDisplay::tabbed([
				'Guide activity' => $guide_activity,
				'Tripadvisor'    => $tripadvisor,
				'Bus data'       => $bus_data
			]);
		}
		
		$form->addElement($tabs);
		
		return $form;
	});
	
	$model->onCreate(function () {
		
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$warning_bus_est_time = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>120</small></div>';
		$warning_bus_est_exp = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>1500</small></div>';
		
		$guide_activity = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::text('name', 'Name')->required()
				], 6)
				->addColumn([
					AdminFormElement::select('category', 'Category')->required()->setOptions([
						'Visual'    => 'Visual',
						'Caminatas' => 'Caminatas',
						'Termas'    => 'Termas'
					])
				], 2)
				->addColumn([
					AdminFormElement::select('page', 'PAGE')->required()->setOptions([
						'bus'      => 'By car or bus',
						'cultural' => 'Cultural tour',
						'bicycle'  => 'Bicycle'
					])
				], 2)
				->addColumn([
					AdminFormElement::select('region', 'REGION')->required()->setOptions([
                        'pucon'   => 'Pucon',
                        'atacama' => 'Atacama',
                        'valparaiso' => 'Valparaiso',
                        'torresDelPaine' => 'Torres del Paine',
                        'santigo' => 'Santigo',
					])
				], 2),
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::text('instagram_id', 'Instagram')->required()
				], 4)
				->addColumn([
					AdminFormElement::text('latitude', 'Latitude')->required()
				], 4)
				->addColumn([
					AdminFormElement::text('longitude', 'Longitude')->required()
				], 4),
			AdminFormElement::text('short_description', 'Short description')->required(),
			AdminFormElement::textarea('description', 'Description')->required(),
			AdminFormElement::columns()
//					->addColumn([
//						AdminFormElement::textarea('real_time_ranges', 'Time')->required(),
//					], 8)
				->addColumn([
					AdminFormElement::image('image', 'Image'),
				], 12),
		]);
		
		$tripadvisor = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::textarea('tripadvisor_code', 'Tripadvisor code'),
		]);
		
		$route = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::textarea('route', 'Route (json)'),
			AdminFormElement::html($warning_bus_est_time),
			AdminFormElement::text('real_bus_est_time', 'Est. time (in minutes)'),
		]);
		
		$bus_data = new \SleepingOwl\Admin\Form\FormElements([
			AdminFormElement::columns()
				->addColumn([
					AdminFormElement::html($warning_bus_est_time),
					AdminFormElement::text('real_bus_est_time', 'Est. time (in minutes)'),
				], 6)
				->addColumn([
					AdminFormElement::html($warning_bus_est_exp),
					AdminFormElement::text('bus_est_expenditure', 'Est. expenditure (per person)'),
				], 6),
//					->addColumn([
//						AdminFormElement::text('bus_est_service', 'Est. service (per person)'),
//					], 4),
			AdminFormElement::textarea('bus_description', 'Description'),
		]);
		
		$tabs = AdminDisplay::tabbed([
			'Guide activity' => $guide_activity,
			'Tripadvisor'    => $tripadvisor,
			'Bus data'       => $bus_data,
			'Route'          => $route
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
});