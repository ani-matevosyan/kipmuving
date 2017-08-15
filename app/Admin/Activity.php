<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Activity;

AdminSection::registerModel(Activity::class, function (ModelConfiguration $model) {
	
	$model->enableAccessCheck();
	
	$model->setTitle('Activities');
	
	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			$icon = AdminColumn::image('image_icon', 'Icon')
				->setHtmlAttribute('class', 'hidden-sm hidden-xs')
				->setImageWidth('50px')
				->setOrderable(false),
			AdminColumn::text('region', 'Region')
				->setHtmlAttribute('class', 'text-center')
				->append(
					AdminColumn::filter('region')
				),
			$id = AdminColumn::text('id', '#')
				->setHtmlAttribute('class', 'text-center'),
			$name = AdminColumn::text('name', 'Name')
				->setHtmlAttribute('class', 'text-center'),
			$style = AdminColumn::text('styles', 'Style')
				->setHtmlAttribute('class', 'text-center'),
			$instagram = AdminColumn::text('instagram_name', 'Instagram')
				->setHtmlAttribute('class', 'text-center'),
			$age = AdminColumn::text('min_age', 'Min. age')
				->setHtmlAttribute('class', 'text-center'),
//			$availability = AdminColumn::custom('Available')
//				->setHtmlAttribute('class', 'text-center')
//				->setCallback(function ($instance) {
//				return $instance->availability ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
//			}),
			$visibility = AdminColumn::custom('Visible')
				->setHtmlAttribute('class', 'text-center')
				->setCallback(function ($instance) {
					return $instance->visibility ? '<i class="fa fa-check"></i>' : '<i class="fa fa-times"></i>';
				})
		]);
		
		$icon->getHeader()->setHtmlAttribute('class', 'text-center');
		$id->getHeader()->setHtmlAttribute('class', 'text-center');
		$name->getHeader()->setHtmlAttribute('class', 'text-center');
		$style->getHeader()->setHtmlAttribute('class', 'text-center');
		$instagram->getHeader()->setHtmlAttribute('class', 'text-center');
		$age->getHeader()->setHtmlAttribute('class', 'text-center');
		$visibility->getHeader()->setHtmlAttribute('class', 'text-center');
		
		$display->setOrder([[1, 'asc']]);
		
		$display->setFilters(
			AdminDisplayFilter::related('region')
		);
		
		$display->paginate(10);
		
		return $display;
	});
	
	$model->onCreateAndEdit(function () {
		$warning_carries = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>Zapatillas para mojar;<br>Ropa seca para después del viaje;<br><strong>In the last element you don\'t need ";"</strong></small></div>';
		$warning_restrictions = '<div class="alert bg-warning text-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><small><strong>For example:</strong><br>Se requiere un buen estado físico para realiza esta actividad;<br>Para realizar esta actividad, hay que saber nadar y no tener algún impedimento físico que le impida ver, oír y nadar;<br><strong>In the last element you don\'t need ";"</strong></small></div>';
		
		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');
		
		$tabs = AdminDisplay::tabbed([
			'Activity'     => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('name', 'Name')->required(),
					], 9)
					->addColumn([
						AdminFormElement::select('region', 'REGION')->setOptions([
							'pucon' => 'Pucon',
							'atacama' => 'Atacama'
						])->required(),
					], 3),
				AdminFormElement::text('subtitle', 'Subtitle')->required(),
				AdminFormElement::textarea('short_description', 'Short description')->required(),
				AdminFormElement::textarea('description', 'Description')->required(),
				
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('latitude', 'Latitude')->required(),
						AdminFormElement::select('styles', 'Style')->required()->setOptions([
							'Trekking' => 'Trekking',
							'Rio'      => 'Rio',
							'Aire'     => 'Aire',
							'Relax'    => 'Relax',
							'Familia'  => 'Familia',
							'Nieve'    => 'Nieve',
							'Ciclismo' => 'Ciclismo'
						]),
					], 4)
					->addColumn([
						AdminFormElement::text('longitude', 'Longitude')->required(),
						AdminFormElement::text('instagram_name', 'Instagram')
					], 4)
					->addColumn([
						AdminFormElement::number('min_age', 'Min age')->required()
					], 4),
				
				AdminFormElement::columns()
					->addColumn([
//						AdminFormElement::checkbox('availability', 'Available'),
						AdminFormElement::checkbox('visibility', 'Visible'),
					], 2)
					->addColumn([
						AdminFormElement::checkbox('slider', 'Slider on homepage'),
						AdminFormElement::checkbox('slider_activities_page', 'Slider on activities page'),
					], 3)
					->addColumn([
						AdminFormElement::checkbox('available_day', 'Available on day'),
						AdminFormElement::checkbox('available_night', 'Available on night'),
					], 3)
					->addColumn([
						AdminFormElement::checkbox('available_high', 'Available from March to November'),
						AdminFormElement::checkbox('available_low', 'Available from December to March'),
					], 4),
				
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::image('image', 'Image'),
					], 4)
					->addColumn([
						AdminFormElement::image('image_thumb', 'Image thumb'),
					], 4)
					->addColumn([
						AdminFormElement::image('image_icon', 'Image icon'),
					], 4)
			]),
			'Carry'        => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::html($warning_carries),
				AdminFormElement::textarea('real_carries', 'Carry')->required()
			]),
			'Restrictions' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::html($warning_restrictions),
				AdminFormElement::textarea('real_restrictions', 'Restrictions')->required(),
			]),
			'Weather'      => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('weather_embed', 'Weather embed'),
			]),
			'Tripadvisor'  => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::textarea('real_tripadvisor_code', 'Tripadvisor code'),
			]),
			'Gallery'      => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::images('images', 'Images'),
			])
		]);
		
		$form->addElement($tabs);
		
		return $form;
	});
	
});