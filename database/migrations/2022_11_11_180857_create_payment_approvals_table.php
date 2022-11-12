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
        Schema::create('payment_approvals', function (Blueprint $table) {
            $table->integer('id', true)->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('payment_id')->unsigned();
            $table->string('payment_type');
            $table->enum('status', config('renhead.payment.approval.status'));
            $table->dateTime('created_at');
            $table->dateTime('updated_at');
            $table->dateTime('deleted_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('payment_id')
                ->references('id')
                ->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_approvals');
    }
};
