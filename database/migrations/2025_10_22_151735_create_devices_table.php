<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name')->index();             // friendly label
            $table->string('slug')->unique();            // for URLs/dashboard
            $table->string('api_key')->unique();         // simple device auth
            $table->json('meta')->nullable();            // location, notes, etc.
            $table->timestampsTz();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
