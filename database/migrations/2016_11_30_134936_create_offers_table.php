<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('offers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('activity_id');
			$table->integer('agency_id');
			$table->integer('price');
			$table->integer('price_offer');
			$table->integer('persons');
			$table->integer('min_age');
			$table->date('available_start');
			$table->date('available_end');
			$table->boolean('availability');
			$table->decimal('break_start', 5, 2);
			$table->decimal('break_close', 5, 2);
			$table->timestamps();
		});

		Schema::create('offer_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('offer_id')->unsigned();
			$table->string('locale')->index();

			$table->text('includes');
			$table->string('cancellation_rules');
//			$table->text('restrictions');
			$table->text('important');
//			$table->text('carry');
			$table->text('description');

			$table->unique(['offer_id', 'locale']);
			$table->foreign('offer_id')->references('id')->on('offers')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('offers');
	}
}
