<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInstagramIdFieldToAgenciesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
//		Schema::table('agencies', function (Blueprint $table) {
//			//
//			$table->char('instagram_id', 15)->nullable();
//		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('agencies', function (Blueprint $table) {
//			//
//			$table->removeColumn('instagram_id');
//		});
	}
}
