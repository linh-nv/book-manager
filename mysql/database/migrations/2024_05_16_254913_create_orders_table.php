<?php

use App\Enums\PaymentStatus;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('user_address_id')->constrained('addresses')->onDelete('cascade');
            $table->foreignId('coupon_user_id')->constrained('coupon_users')->onDelete('cascade')->nullable();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade')->nullable();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->text('address');
            $table->foreignId('province_id')->constrained('cities')->onDelete('cascade');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
            $table->foreignId('ward_id')->constrained('communes')->onDelete('cascade');
            $table->decimal('price_sale_off', 19, 4)->default(0);
            $table->decimal('shipping_fee', 19, 4)->default(0);
            $table->decimal('total_money', 19, 4)->default(0);
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('canceled_at')->nullable()->default(0);
            $table->tinyInteger('payment_type')->nullable()->default(0);
            $table->tinyInteger('status')->default(PaymentStatus::UNPAY->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
