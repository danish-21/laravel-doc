<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CartDetail
 * 
 * @property int $id
 * @property int $cart_id
 * @property int $product_id
 * @property int $quantity
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Cart $cart
 * @property Product $product
 *
 * @package App\Models
 */
class CartDetail extends Model
{
	use SoftDeletes;
	protected $table = 'cart_details';

	protected $casts = [
		'cart_id' => 'int',
		'product_id' => 'int',
		'quantity' => 'int'
	];

	protected $fillable = [
		'cart_id',
		'product_id',
		'quantity'
	];

	public function cart()
	{
		return $this->belongsTo(Cart::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
