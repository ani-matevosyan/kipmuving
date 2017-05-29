<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\GuideActivity;

AdminSection::registerModel(GuideActivity::class, function (ModelConfiguration $model) {

//	$model->enableAccessCheck();
	
	$model->setTitle('Guide activities');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id', '#'),
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
	
	$model->onCreateAndEdit(function () {
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		$warning_bus_est_time = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>120</small></div>';
		$warning_bus_est_exp = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>1500</small></div>';
		$tabs = AdminDisplay::tabbed([
			'Guide activity' => new \SleepingOwl\Admin\Form\FormElements([
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
					], 3)
					->addColumn([
						AdminFormElement::select('region', 'REGION')->required()->setOptions([
							'pucon' => 'Pucon',
							'atacama' => 'Atacama'
						])
					], 3),
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
			]),
			'Tripadvisor'    => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('tripadvisor_code', 'Tripadvisor code'),
			]),
			'Bus data'       => new \SleepingOwl\Admin\Form\FormElements([
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
			])
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
})
	->addMenuPage(GuideActivity::class, 5)
	->setIcon('fa fa-map-marker');