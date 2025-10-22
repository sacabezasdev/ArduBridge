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
            $table->char('device_id', 26); // ULID FK
            $table->string('metric');
            $table->decimal('value', 10, 3);
            $table->string('unit')->nullable();
            $table->timestampTz('recorded_at');
            $table->json('payload')->nullable();
            $table->timestamps();

            $table->foreign('device_id')->references('id')->on('devices')->cascadeOnDelete();
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

