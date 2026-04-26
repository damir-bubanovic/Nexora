<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->decimal('estimated_hours', 8, 2)->nullable()->after('due_date');
            $table->decimal('actual_hours', 8, 2)->nullable()->after('estimated_hours');
            $table->decimal('agreed_cost', 10, 2)->nullable()->after('actual_hours');
        });
    }

    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropColumn([
                'estimated_hours',
                'actual_hours',
                'agreed_cost',
            ]);
        });
    }
};
