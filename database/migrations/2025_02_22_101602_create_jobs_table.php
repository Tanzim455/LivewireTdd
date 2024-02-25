<?php

use App\Models\Category;
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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->integer('min_experience');
            $table->integer('max_experience');
            $table->integer('min_salary');
            $table->integer('max_salary');
            $table->string('apply_url')->nullable();
            $table->date('expiration_date');
            $table->string('job_location');
            $table->enum('job_location_type',['remote', 'onsite', 'hybrid']);
            $table->unsignedBigInteger('category_id')->references('id')->on('categories');
            $table->softDeletes();
          
             $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
        
    }
};
