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
       Schema::table('admins', function (Blueprint $table) {
        $table->foreignId('role_id')
          ->nullable()
          ->constrained('roles')
          ->onDelete('set null'); // hoặc cascade nếu bạn muốn admin bị xóa nếu role bị xóa
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admins', function (Blueprint $table) {
        // Xóa foreign key trước
        $table->dropForeign(['role_id']);

        // Sau đó xóa cột
        $table->dropColumn('role_id');
    });
    }
};
