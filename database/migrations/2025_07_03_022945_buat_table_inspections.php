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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();
            // $table->bigInteger('user_id')->unsigned();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // hanya guna kod ini jika ikut best practice naming convention
            $table->date('tarikh')->nullable(); // column data jenis date, allow null
            $table->time('masa')->nullable(); // column data jenis time, allow null
            $table->string('tempat'); // column data jenis varchar dan WAJIB ada data
            $table->string('tempat_sub')->nullable(); // column data jenis varchar, allow null
            $table->text('remarks')->nullable(); // column data jenis text dan allow null
            $table->string('status', 50)->default('draft'); // column data jenis varchar, limit 50 chars dan default value draft
            $table->timestamps(); // created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections');
    }
};
