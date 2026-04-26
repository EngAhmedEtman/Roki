<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('subtitle'); // Admin-only notes
            $table->string('link')->nullable()->after('notes');   // Admin-only link
        });
    }

    public function down(): void
    {
        Schema::table('designs', function (Blueprint $table) {
            $table->dropColumn(['notes', 'link']);
        });
    }
};
