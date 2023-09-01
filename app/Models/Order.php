<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $cart_id
 * @property float $total_amount
 * @property string $payment_option
 * @property string $order_number
 * @property int $shipping_address_id
 * @property int $billing_address_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property UserAddress $user_address
 * @property Cart $cart
 * @property User $user
 * @property Collection|OrderDetail[] $order_details
 * @property Collection|Paytm[] $paytms
 *
 * @package App\Models
 */
class Order extends Model
{
	use SoftDeletes;
	protected $table = 'orders';

	protected $casts = [
		'user_id' => 'int',
		'cart_id' => 'int',
		'total_amount' => 'float',
		'shipping_address_id' => 'int',
		'billing_address_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'cart_id',
        'order_number',
		'total_amount',
		'payment_option',
		'shipping_address_id',
		'billing_address_id'
	];

	public function user_address()
	{
		return $this->belongsTo(UserAddress::class, 'shipping_address_id');
	}

	public function cart()
	{
		return $this->belongsTo(Cart::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}

	public function paytms()
	{
		return $this->hasMany(Paytm::class);
	}
}
