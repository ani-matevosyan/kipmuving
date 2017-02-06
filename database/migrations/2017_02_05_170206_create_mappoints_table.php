<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMappointsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mappoints', function (Blueprint $table) {
			$table->increments('id');
			$table->string('point_id', 32);
			$table->integer('bus_est_time')->default(0);
			$table->integer('bus_est_expenditure')->default(0);
			$table->integer('bus_est_service')->default(0);
			$table->text('tripadvisor_code')->nullable();
		});
		
		Schema::create('mappoint_translations', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('mappoint_id')->unsigned();
			$table->string('locale')->index();
			
			$table->text('description')->nullable();
			$table->text('bus_description')->nullable();
			
			$table->unique(['mappoint_id', 'locale']);
			$table->foreign('mappoint_id')->references('id')->on('mappoints')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('mappoints');
		Schema::dropIfExists('mappoint_translations');
	}
}
