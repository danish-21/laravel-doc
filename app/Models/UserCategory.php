<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class UserCategory
 * 
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property User $user
 *
 * @package App\Models
 */
class UserCategory extends Model
{
	use SoftDeletes;
	protected $table = 'user_categories';

	protected $casts = [
		'user_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'user_id',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
