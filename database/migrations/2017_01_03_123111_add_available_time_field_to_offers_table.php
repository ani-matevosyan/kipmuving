<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailableTimeFieldToOffersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::table('offers', function (Blueprint $table) {
//			//
//			$table->text('available_time')->nullable();
//		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('offers', function (Blueprint $table) {
//			//
//			$table->removeColumn('available_time');
//		});
	}
}
