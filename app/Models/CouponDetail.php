<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class CouponDetail
 * 
 * @property int $id
 * @property int $product_id
 * @property int $coupon_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Coupon $coupon
 * @property Product $product
 *
 * @package App\Models
 */
class CouponDetail extends Model
{
	use SoftDeletes;
	protected $table = 'coupon_details';

	protected $casts = [
		'product_id' => 'int',
		'coupon_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'coupon_id'
	];

	public function coupon()
	{
		return $this->belongsTo(Coupon::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
