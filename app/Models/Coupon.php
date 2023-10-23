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
 * Class Coupon
 * 
 * @property int $id
 * @property string $code
 * @property string $discount_type
 * @property string $value
 * @property Carbon $starts_at
 * @property Carbon $expires_at
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|CouponDetail[] $coupon_details
 *
 * @package App\Models
 */
class Coupon extends Model
{
	use SoftDeletes;
	protected $table = 'coupons';

	protected $casts = [
		'starts_at' => 'datetime',
		'expires_at' => 'datetime'
	];

	protected $fillable = [
		'code',
		'discount_type',
		'value',
		'starts_at',
		'expires_at'
	];

	public function coupon_details()
	{
		return $this->hasMany(CouponDetail::class);
	}
}
