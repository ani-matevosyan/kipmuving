<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('activities', function (Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('styles');
			$table->boolean('availability')->default(true);
//			$table->date('available_start');
//			$table->date('available_end');
			$table->boolean('visibility')->default(false);
			$table->string('image');
			$table->string('image_thumb');
			$table->string('image_icon');
//			$table->integer('min_age');
			$table->decimal('latitude', 9, 5);
			$table->decimal('longitude', 9, 5);
		});

		Schema::create('activity_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('activity_id')->unsigned();
			$table->string('locale')->index();
			$table->string('name');
			$table->string('subtitle');
			$table->text('short_description');
			$table->text('description');
			$table->text('carry');
			$table->text('restrictions');

			$table->unique(['activity_id', 'locale']);
			$table->foreign('activity_id')->references('id')->on('activities')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('activities');
		Schema::dropIfExists('activity_translations');
	}
}
