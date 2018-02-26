<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\SuggestionDay;

AdminSection::registerModel(SuggestionDay::class, function (ModelConfiguration $model) {
	$model->setTitle('Suggestion days');

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables();

		$display->setColumns([
			AdminColumn::text('order_', 'Order')
			->setWidth(100)
			->setOrderable(false),
			AdminColumn::text('name', 'Name'),
		]);

		$display->setOrder([[0, 'asc']]);

		return $display;
	});

	$model->onEdit(function ($id) {
		$form = AdminForm::panel();

		$activities = AdminSection::getModel(\App\SuggestionDayActivity::class)->fireDisplay();
		$activities->getScopes()->push(['withSuggestionDay', $id]);
		$activities->setParameter('suggestion_day_id', $id);

		$tabs = AdminDisplay::tabbed([
			'Suggestion' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
					->addColumn([
						AdminFormElement::text('order_', 'Order')->required(),
					], 3)
					->addColumn([
						AdminFormElement::text('name', 'Name')->required(),
					], 9),
				AdminFormElement::textarea('description', 'Description')->required(),
				$activities
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});

});