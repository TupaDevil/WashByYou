<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('address');

            $table->dateTime('service_datetime');
            $table->enum('service_type', [
                'general_cleaning',
                'deep_cleaning',
                'post_construction_cleaning',
                'carpet_furniture_cleaning'
            ]);
            $table->enum('payment_type', ['cash', 'card']);
            $table->enum('status', ['new', 'in_progress', 'completed', 'cancelled'])->default('new');
            $table->text('cancel_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
