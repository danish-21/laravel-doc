<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticable;
use Laravel\Passport\HasApiTokens;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $password
 * @property bool|null $is_active
 * @property bool|null $verification_status
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|UserOtp[] $user_otps
 *
 * @package App\Models
 */
class User extends Authenticable
{
	use SoftDeletes;
    use HasApiTokens;
	protected $table = 'users';

	protected $casts = [
		'is_active' => 'bool',
		'verification_status' => 'bool'
	];

	protected $hidden = [
		'password'
	];

	protected $fillable = [
		'name',
		'phone',
		'email',
		'password',
		'is_active',
		'verification_status'
	];

	public function user_otps()
	{
		return $this->hasMany(UserOtp::class);
	}
}
