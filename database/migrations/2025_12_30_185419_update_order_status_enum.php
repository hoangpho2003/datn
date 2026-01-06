<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        DB::statement("
        ALTER TABLE orders
        MODIFY status ENUM(
            'pending',
            'ordered',
            'paid',
            'delivered',
            'canceled'
        ) DEFAULT 'ordered'
    ");
    }

    public function down()
    {
        DB::statement("
        ALTER TABLE orders
        MODIFY status ENUM(
            'ordered',
            'delivered',
            'canceled'
        ) DEFAULT 'ordered'
    ");
    }

};
