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
 * Class UserAddress
 * 
 * @property int $id
 * @property string $address
 * @property string $phone
 * @property string|null $building
 * @property string|null $street
 * @property string|null $area
 * @property int $zipcode
 * @property string $city
 * @property string $state
 * @property string $country
 * @property int|null $user_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User|null $user
 * @property Collection|Order[] $orders
 *
 * @package App\Models
 */
class UserAddress extends Model
{
	use SoftDeletes;
	protected $table = 'user_addresses';

	protected $casts = [
		'zipcode' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'address',
		'phone',
		'building',
		'street',
		'area',
		'zipcode',
		'city',
		'state',
		'country',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function orders()
	{
		return $this->hasMany(Order::class, 'shipping_address_id');
	}
}
