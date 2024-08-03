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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id')->unique()->nullable();
            $table->bigInteger('district_id')->unsigned()->nullable();
            $table->bigInteger('village_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin-kelurahan','admin-kecamatan', 'superadmin', 'admin']);
            $table->boolean('is_active')->default(0);
            $table->rememberToken();
            $table->timestamps();
            $table->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->foreign('village_id')
                ->references('id')
                ->on('villages')
                ->onDelete('set null')
                ->onUpdate('cascade');
            $table->index('username');
            $table->index('email');
            $table->index('password');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email');
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
