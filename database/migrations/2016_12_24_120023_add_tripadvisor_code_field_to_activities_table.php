<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTripadvisorCodeFieldToActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::table('activities', function (Blueprint $table) {
//			//
//			$table->text('tripadvisor_code')->nullable();
//		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('activities', function (Blueprint $table) {
//			//
//			$table->removeColumn('tripadvisor_code');
//		});
	}
}
