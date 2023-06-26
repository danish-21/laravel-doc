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
 * Class Cart
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property User $user
 * @property Collection|CartDetail[] $cart_details
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class Cart extends Model
{
	use SoftDeletes;
	protected $table = 'carts';

	protected $casts = [
		'user_id' => 'int'
	];

	protected $fillable = [
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function cart_details()
	{
		return $this->hasMany(CartDetail::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class);
	}
//    public function items()
//    {
//        return $this->hasMany(CartItem::class);
//    }
}
