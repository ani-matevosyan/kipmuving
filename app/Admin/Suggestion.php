<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\Suggestion;

AdminSection::registerModel(Suggestion::class, function (ModelConfiguration $model) {
	$model->setTitle('Suggestions');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables()->setColumns([
			AdminColumn::text('id', '#')
				->setWidth(100),
			AdminColumn::text('name', 'Name'),
			AdminColumn::text('weather', 'Weather')
				->append(
					AdminColumn::filter('weather')
				),
			AdminColumn::text('time_of_day', 'Time of day')
				->append(
					AdminColumn::filter('time_of_day')
				),
			AdminColumn::text('intensity', 'Intensity')
				->append(
					AdminColumn::filter('intensity')
				),
			AdminColumn::text('category', 'Category')
				->append(
					AdminColumn::filter('category')
				),
		]);

		$display->paginate(10);

		$display->setFilters(
			AdminDisplayFilter::related('category'),
			AdminDisplayFilter::related('intensity'),
			AdminDisplayFilter::related('time_of_day'),
			AdminDisplayFilter::related('weather')
		);

		return $display;
	});

	$model->onCreate(function () {

		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$tabs = AdminDisplay::tabbed([
			'Suggestion' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('name', 'Name')->required(),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::textarea('short_description', 'Short description')->required(),
					], 4)
					->addColumn([
						AdminFormElement::textarea('description', 'Description')->required(),
					], 8),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::select('weather', 'Weather')->required()->setOptions([
							'sun'  => 'Sun',
							'cold' => 'Cold',
							'warm' => 'Warm',
							'rain' => 'Rain',
						]),
					], 3)
					->addColumn([
						AdminFormElement::select('time_of_day', 'Time of day')->required()->setOptions([
							'morning'   => 'Morning',
							'afternoon' => 'Afternoon',
							'night'     => 'Night',
						]),
					], 3)
					->addColumn([
						AdminFormElement::select('intensity', 'Intensity')->required()->setOptions([
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
						]),
					], 3)
					->addColumn([
						AdminFormElement::select('category', 'Category')->required()->setOptions([
							'hiking'   => 'Hiking',
							'view'     => 'View',
							'ski'      => 'Ski',
							'bicycle'  => 'Bicycle',
							'climbing' => 'Climbing',
						]),
					], 3)
					->addColumn([
						AdminFormElement::image('image', 'Image'),
					], 12),
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});

	$model->onEdit(function ($id) {

		$suggestion = Suggestion::find($id);

		$form = AdminForm::panel()->setHtmlAttribute('enctype', 'multipart/form-data');

		$days = AdminSection::getModel(\App\SuggestionDay::class)->fireDisplay();
		$days->getScopes()->push(['withSuggestion', $id]);
		$days->setParameter('suggestion_id', $id);

		$tabs = AdminDisplay::tabbed([
			'Suggestion' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::text('name', 'Name')->required(),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::textarea('short_description', 'Short description')->required(),
					], 4)
					->addColumn([
						AdminFormElement::textarea('description', 'Description')->required(),
					], 8),

				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::select('weather', 'Weather')->required()->setOptions([
							'sun'  => 'Sun',
							'cold' => 'Cold',
							'warm' => 'Warm',
							'rain' => 'Rain',
						]),
					], 3)
					->addColumn([
						AdminFormElement::select('time_of_day', 'Time of day')->required()->setOptions([
							'morning'   => 'Morning',
							'afternoon' => 'Afternoon',
							'night'     => 'Night',
						]),
					], 3)
					->addColumn([
						AdminFormElement::select('intensity', 'Intensity')->required()->setOptions([
							'1' => '1',
							'2' => '2',
							'3' => '3',
							'4' => '4',
						]),
					], 3)
					->addColumn([
						AdminFormElement::select('category', 'Category')->required()->setOptions([
							'hiking'   => 'Hiking',
							'view'     => 'View',
							'ski'      => 'Ski',
							'bicycle'  => 'Bicycle',
							'climbing' => 'Climbing',
						]),
					], 3)
					->addColumn([
						AdminFormElement::image('image', 'Image'),
					], 12),
				$days
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});
});