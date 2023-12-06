<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            DB::beginTransaction();

            Schema::create('motorcycles', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('category_id');
                $table->integer('brand_id');
                $table->string('model');
                $table->integer('engine_volume');
                $table->integer('cylinders_count');
                $table->integer('horse_power');
                $table->integer('year');
                $table->integer('mileage')->nullable();
                $table->integer('tires_id')->nullable();
                $table->integer('muffler_type_id')->nullable();
                $table->string('insurance')->nullable();
                $table->text('description')->nullable();
                $table->boolean('status');
                $table->timestamps();
            });

            Schema::create('categories', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('code');
                $table->string('description')->nullable();
                $table->timestamps();
            });

            Schema::create('brands', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('code');
                $table->string('description')->nullable();
                $table->timestamps();
            });

            Schema::create('tires', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('code');
                $table->timestamps();
            });

            Schema::create('mufflers', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('code');
                $table->timestamps();
            });

            Schema::create('images', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('motorcycle_id');
                $table->string('path');
                $table->timestamps();
            });

            Schema::create('bookings', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('motorcycle_id');
                $table->integer('user_id');
                $table->date('date_from');
                $table->date('date_to');
                $table->integer('status_id');
                $table->timestamps();
            });

            Schema::create('booking_statuses', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('name');
                $table->string('code');
                $table->timestamps();
            });

            Schema::table('users', function (Blueprint $table) {
                $table->bigInteger('telegram_id');
            });

            DB::commit();
        } catch (Exception $e) {
            dump($e->getMessage());
            DB::rollBack();
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycles');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('brands');
        Schema::dropIfExists('tires');
        Schema::dropIfExists('mufflers');
        Schema::dropIfExists('images');
        Schema::dropIfExists('bookings');
        Schema::dropIfExists('booking_statuses');
    }
};
