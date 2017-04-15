<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuideActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('guide_activities', function (Blueprint $table) {
			$table->increments('id');
			$table->string('image')->nullable();
			$table->text('tripadvisor_code')->nullable();
			$table->string('instagram_id');
			$table->decimal('latitude', 9, 5);
			$table->decimal('longitude', 9, 5);
			$table->integer('bus_est_time')->default(0);
			$table->integer('bus_est_expenditure')->default(0);
			$table->integer('bus_est_service')->default(0);
			$table->text('time_ranges')->nullable();
//			$table->string('point_id', 32);
//			$table->text('tripadvisor_code')->nullable();
		});
		
		Schema::create('guide_activities_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('guide_activity_id')->unsigned();
			$table->string('locale')->index();
			
			$table->text('name')->nullable();
			$table->string('short_description')->nullable();
			$table->text('description')->nullable();
			$table->text('bus_description')->nullable();
			
			$table->unique(['guide_activity_id', 'locale']);
			$table->foreign('guide_activity_id')->references('id')->on('guide_activities')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('guide_activities');
		Schema::dropIfExists('guide_activities_translations');
	}
}
