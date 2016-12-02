<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToActivitiesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('activities', function (Blueprint $table) {
			//
			$table->text('weather_embed')->nullable();
			$table->boolean('available_night')->default(false);
			$table->boolean('available_day')->default(false);
			$table->boolean('available_high')->default(false);
			$table->boolean('available_low')->default(false);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('activities', function (Blueprint $table) {
			$table->dropColumn([
				'weather_embed',
				'available_night',
				'available_day',
				'available_high',
				'available_low'
			]);
		});
	}
}
