<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
	        $table->increments('id');
	        $table->string('type', 32)->default(''); #Payment type (for example paypal/pagseguro/payu...)
	        $table->boolean('status')->default(false); #Payment status. If true - transaction paid and completed
	        $table->string('status_code', 64)->default(''); #Payment status code (different for payments, for example ok/success/etc.)
	        $table->string('lang_code', 10)->default('en'); #Language code at the time of reservation
	        $table->integer('user_id');
	        $table->integer('offer_id');
	        $table->integer('persons');
	        $table->date('reserve_date');
	        $table->string('time_range', 17); #Time of reserved offer from... to (format: HH:mm:ss-HH:mm:ss)
	        $table->string('payment_uid', 128)->default(''); #Unique code for different payments
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
        Schema::dropIfExists('reservations');
    }
}
