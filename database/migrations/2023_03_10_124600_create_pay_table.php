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
        Schema::create('pay', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id')->nullable()->default(null);
            $table->string('client_phone')->nullable()->default(null);
            $table->decimal('sum');
            $table->boolean('is_cancelled')->default(false)->nullable();
            $table->timestamps();
        });
        
        Schema::table('pay', function (Blueprint $table) {
            $table->index('client_id');
            $table->index('client_phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pay', function (Blueprint $table) {
            $table->dropIndex('pay_client_phone_index');
            $table->dropIndex('pay_client_id_index');            
        });
        
        Schema::dropIfExists('pay');
    }
};
