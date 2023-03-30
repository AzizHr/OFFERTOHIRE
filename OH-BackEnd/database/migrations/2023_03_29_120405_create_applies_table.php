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
        Schema::create('applies', function (Blueprint $table) {
            $table->foreignId('offer_id')->constrained('offers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('from_user')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('to_company')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['offer_id' , 'from_user' , 'to_company']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applies');
    }
};
