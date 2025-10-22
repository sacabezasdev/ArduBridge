<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->ulid('device_id');
            $table->string('metric');                 // e.g., "distance_cm"
            $table->double('value')->nullable();      // numeric value if applicable
            $table->string('unit')->nullable();       // "cm","C","%"
            $table->timestampTz('recorded_at')->index(); // when Arduino measured
            $table->json('payload')->nullable();      // raw body (we'll upgrade to JSONB)
            $table->timestampsTz();

            $table->foreign('device_id')->references('id')->on('devices')->cascadeOnDelete();
            $table->index(['device_id', 'metric', 'recorded_at']);
        });

        // Ensure payload uses JSONB (better indexing/operators). On Postgres,
        // Laravel's "json" is fine, but GIN indexing needs jsonb:
        DB::statement("ALTER TABLE measurements ALTER COLUMN payload TYPE jsonb USING payload::jsonb");
        // Optional: GIN index for querying inside JSON payload
        DB::statement("CREATE INDEX measurements_payload_gin ON measurements USING GIN (payload)");
    }

    public function down(): void
    {
        Schema::dropIfExists('measurements');
    }
};

