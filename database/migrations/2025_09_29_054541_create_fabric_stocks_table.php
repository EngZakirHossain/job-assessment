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
        Schema::create('fabric_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fabric_id')->index();
            $table->enum('type', ['in', 'out']); // in = add stock, out = remove/issue
            $table->integer('qty');
            $table->text('remarks')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('fabric_id')->references('id')->on('fabrics')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabric_stocks');
    }
};
