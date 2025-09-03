<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['male', 'female']);
            $table->string('phone_number');
            $table->date('birth_date');
            $table->unsignedBigInteger('gyms_id'); // relación al gimnasio
            $table->timestamps();

            // Asegurate de tener la tabla gyms creada si usás esta foreign
            $table->foreign('gyms_id')->references('id')->on('gyms')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};

