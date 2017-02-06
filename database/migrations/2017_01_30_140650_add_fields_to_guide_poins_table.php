<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToGuidePoinsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::table('guide_points', function (Blueprint $table) {
//			//
//			$table->integer('bus_estimated_time')->default(0);
//			$table->integer('bus_estimated_expenditure')->default(0);
//			$table->integer('bus_estimated_service')->default(0);
//		});
//		Schema::table('guide_point_translations', function (Blueprint $table) {
//			//
//			$table->text('bus_description')->nullable();
//		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('guide_points', function (Blueprint $table) {
//			//
//			$table->removeColumn('bus_estimated_time');
//			$table->removeColumn('bus_estimated_expenditure');
//			$table->removeColumn('bus_estimated_service');
//		});
//		Schema::table('guide_point_translations', function (Blueprint $table) {
//			//
//			$table->removeColumn('bus_description');
//		});
	}
}
