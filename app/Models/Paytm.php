<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Paytm
 * 
 * @property int $id
 * @property string $name
 * @property int $mobile
 * @property string $email
 * @property int $status
 * @property int $amount
 * @property int $order_id
 * @property string $transaction_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class Paytm extends Model
{
	use SoftDeletes;
	protected $table = 'paytms';

	protected $casts = [
		'mobile' => 'int',
		'status' => 'int',
		'amount' => 'int',
		'order_id' => 'int'
	];

	protected $fillable = [
		'name',
		'mobile',
		'email',
		'status',
		'amount',
		'order_id',
		'transaction_id'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
