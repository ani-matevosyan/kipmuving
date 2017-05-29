<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOffersTable extends Migration
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
//			$table->time('start_time')->default('00:00:00');
//			$table->time('end_time')->default('00:00:00');
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
//			$table->dropColumn([
//				'start_time',
//				'end_time'
//			]);
//		});
	}
}
