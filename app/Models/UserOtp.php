<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserOtp
 * 
 * @property int $id
 * @property int $user_id
 * @property string|null $otp
 * @property string|null $uuid
 * @property Carbon|null $expires_at
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserOtp extends Model
{
	use SoftDeletes;
	protected $table = 'user_otps';

	protected $casts = [
		'user_id' => 'int',
		'expires_at' => 'datetime'
	];

	protected $fillable = [
		'user_id',
		'otp',
		'uuid',
		'expires_at'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
