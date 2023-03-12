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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('phone')->unique();
            $table->string('full_name');
            $table->decimal('balance')->default(0.0);
            $table->string('status')->default('active');
            $table->timestamps();
        });
        
        Schema::table('client', function (Blueprint $table) {
            $table->index('phone');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {       
        Schema::table('client', function (Blueprint $table) {
            $table->dropIndex('client_phone_index');
            $table->dropIndex('client_status_index');
        });
        
        Schema::dropIfExists('client');
    }
};
