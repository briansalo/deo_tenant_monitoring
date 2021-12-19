<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('tenant_id')->nullable();
            $table->tinyInteger('billing_id')->comment('1=rental, 2=electric, 3=water')->nullable();
            $table->date('month')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('or_number')->nullable();
            $table->integer('ar_number')->nullable();
            $table->tinyInteger('status')->comment('0=paid, 1=partial, 2=cancel_OR')->nullable();

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
        Schema::dropIfExists('payments');
    }
}
