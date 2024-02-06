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
        //
        Schema::table('events', function (Blueprint $table) {                        
            $table->text('description')->after('user_id')->nullable();
            $table->string("event_code")->after('description')->nullable();
            $table->string('url')->after('event_code')->nullable();
            $table->tinyInteger("status")->after('event_code')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('event_code');
            $table->dropColumn('url');
            $table->dropColumn('status');
        });
    }
};