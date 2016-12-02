<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('username')->default('');
			$table->string('first_name');
			$table->string('last_name');
			$table->char('gender')->nullable();
			$table->date('birthday')->nullable();
			$table->string('email')->unique();
			$table->string('phone');
			$table->string('avatar')->nullable();
			$table->string('confirmation_code');
			$table->boolean('confirmed')->default(false);
			$table->string('password');
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}
}
