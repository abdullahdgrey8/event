<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {                        
            $table->tinyInteger('is_admin')->after('name')->default(0);
            $table->string("api_key")->after('is_admin')->nullable();            
        });
        $data = array(
            'name'=>'admin',
            'is_admin'=>1,
            'api_key'=>'csnuf3434gd3434fisduifgsuid',
            'email'=>'azeemaslamhh@gamil.com',
            'email_verified_at'=> date("Y-m-d H:i:s"),
            'password'=>Hash::make("abc123**"),       
            'created_at'=> date("Y-m-d H:i:s"),
            'updated_at'=> date("Y-m-d H:i:s")
        );
        DB::table('users')->insert($data);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
            $table->dropColumn('api_key');            
        });
    }
};
