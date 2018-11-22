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
            AdminColumn::text('available_start', 'Start date')->setOrderable(false),
            AdminColumn::text('available_end', 'End date')->setOrderable(false),
            AdminColumn::text('price', 'Price')->setOrderable(false),
            AdminColumn::text('price_offer', 'Offer Price')->setOrderable(false),
		]);

		$display->setOrder([[0, false],[1, false], [2, false],[3, false], [4, false],[5, false],[6, false]]);
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
                        AdminFormElement::html("<div class='returnBackAD' style='display: none'><a href=".'/admin/offers/'.$offerDay->offer_id.'/edit'." class='btn btn-success'>Return Back</a> </div>"),
                    ], 12),
			]),
		]);

		$form->addElement($tabs);

		return $form;
	});

});