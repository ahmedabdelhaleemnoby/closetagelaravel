<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->integer('ship_way');
            $table->integer('pay_way');
            $table->integer('user_id');
            $table->integer('subtotal');
            $table->string('type_card')->nullable();
            $table->string('name')->nullable();
            $table->integer('number')->nullable();
            $table->string('exp')->nullable();
            $table->integer('ccv')->nullable();
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
};
