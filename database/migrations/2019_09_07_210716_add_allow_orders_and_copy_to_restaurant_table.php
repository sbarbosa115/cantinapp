<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAllowOrdersAndCopyToRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('restaurants', static function (Blueprint $table) {
            $table->boolean('allow_orders')->default(true);
            $table->longText('welcome_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('restaurants', static function (Blueprint $table) {
            $table->dropColumn(['allow_orders', 'welcome_text']);
        });
    }
}
