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
        Schema::create('fabrics', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supplier_id')->nullable()->index();
            $table->string('fabric_no')->index();
            $table->string('composition');
            $table->decimal('gsm', 8, 2)->nullable();
            $table->integer('qty')->default(0);
            $table->string('cuttable_width')->nullable();
            $table->enum('production_type', ['Knitting', 'Weaving', 'Dyeing'])->default('Dyeing');

            // optional
            $table->string('construction')->nullable();
            $table->string('color_pantone')->nullable();
            $table->string('weave_type')->nullable();
            $table->string('finish_type')->nullable();
            $table->string('dyeing_method')->nullable();
            $table->string('printing_method')->nullable();
            $table->integer('lead_time_days')->nullable();
            $table->integer('moq')->nullable();
            $table->decimal('shrinkage', 5, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->string('fabric_selected_by')->nullable();

            $table->string('image_path')->nullable();
            $table->string('barcode')->nullable()->unique();

            $table->unsignedBigInteger('added_by')->nullable();
            $table->timestamp('added_date')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamp('updated_date')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabrics');
    }
};
