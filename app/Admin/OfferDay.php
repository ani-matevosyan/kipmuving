<?php

use Illuminate\Pagination\PaginationServiceProvider;
use SleepingOwl\Admin\Model\ModelConfiguration;
use App\OfferDay;
use App\Http\Controllers\AdminOwlController;

AdminSection::registerModel(OfferDay::class, function (ModelConfiguration $model) {
	$model->setTitle('Offer days');
//    $model->setRedirect(['create' => 'display', 'edit' => 'display']);
//    $model->setControllerClass(AdminOwlController::class);

	$model->onDisplay(function () {
		$display = AdminDisplay::datatables();

		$display->setColumns([
            AdminColumn::text('available_start', 'Start date'),
            AdminColumn::text('available_end', 'End date'),
            AdminColumn::text('price', 'price'),
            AdminColumn::text('price_offer', 'Offer price'),
		]);

		$display->setOrder([[0, 'asc']]);

		return $display;
	});

	$model->onCreate(function () {
		$form = AdminForm::panel();

		$tabs = AdminDisplay::tabbed([
			'Offer' => new \SleepingOwl\Admin\Form\FormElements([
                AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::date('available_start', 'Start date')
                            ->setPickerFormat('d.m')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::date('available_end', 'End date')
                            ->setPickerFormat('d.m')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::number('price', 'Price')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::number('price_offer', 'Offer price'),
                        AdminFormElement::hidden('offer_id')
                             ->setDefaultValue(request()['offer_id']),
                    ], 3)
			]),
		]);

		$form->addElement($tabs);
		return $form;
	});

//    $model->created(function(ModelConfiguration $model, OfferDay $offerDay) {
////        header("Location: http://aventuraschile.loc/admin/offers/1/edit");
//        dd();
//    });


	$model->onEdit(function ($id) {
		$form = AdminForm::panel();
        $offerDay = OfferDay::find($id);

		$tabs = AdminDisplay::tabbed([
			'Offer' => new \SleepingOwl\Admin\Form\FormElements([
				AdminFormElement::columns()
                    ->addColumn([
                        AdminFormElement::date('available_start', 'Start date')
                            ->setPickerFormat('d.m')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::date('available_end', 'End date')
                            ->setPickerFormat('d.m')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::number('price', 'Price')
                            ->required(),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::number('price_offer', 'Offer price'),
                    ], 3)
                    ->addColumn([
                        AdminFormElement::html("<a href=".'/admin/offers/'.$offerDay->offer_id.'/edit'." class='btn btn-success'>Return Back</a>"),
                    ], 12),
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});

});