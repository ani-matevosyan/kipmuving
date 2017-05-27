<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('agencies', function (Blueprint $table) {
			$table->increments('id');
			$table->string('address');
			$table->string('email');
			$table->integer('recommendation');
			$table->decimal('latitude', 9, 5);
			$table->decimal('longitude', 9, 5);
			$table->text('tripadvisor_code');
			$table->string('image');
			$table->string('image_thumb');
			$table->string('image_icon');
			$table->timestamps();
		});

		Schema::create('agency_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('agency_id')->unsigned();
			$table->string('locale')->index();
			$table->string('name');
			$table->text('description');

			$table->unique(['agency_id', 'locale']);
			$table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('agencies');
	}
}
