<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContractorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contractors', function(Blueprint $table) {
			$table->increments('id');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('businessname');
			$table->string('email', 320);
			$table->string('password', 64);
			$table->string('phone')->nullable();
			$table->integer('fax')->nullable();
			$table->text('street1');
			$table->text('street2')->nullable();
			$table->string('city');
			$table->string('state');
			$table->string('zip')->nullable();
			$table->string('usertype',32);
			$table->string('logo',128)->nullable();
			$table->integer('cardno')->nullable();
			$table->string('cardholdername',128)->nullable();
			$table->string('expmonth',128)->nullable();
			$table->integer('expyear')->nullable();
			// required for Laravel 4.1.26
            $table->string('remember_token', 100)->nullable();			
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
		Schema::drop('contractors');
	}

}
