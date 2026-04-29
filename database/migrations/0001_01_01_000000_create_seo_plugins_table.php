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
        Schema::create('seo_plugins', function (Blueprint $table) {
            $table->id();
            $table->morphs('seoable');
            $table->unsignedBigInteger('tenant_id')->nullable();
            $table->longText('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->longText('meta_author')->nullable();
            $table->longText('meta_robots')->nullable();
            $table->longText('canonical_tag')->nullable();
            $table->longText('og_title')->nullable();
            $table->longText('og_description')->nullable();
            $table->longText('og_url')->nullable();
            $table->longText('og_image')->nullable();
            $table->longText('twitter_title')->nullable();
            $table->longText('twitter_description')->nullable();
            $table->longText('twitter_image')->nullable();
            $table->longText('twitter_url')->nullable();
            $table->longText('schema')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_plugins');
    }
};
