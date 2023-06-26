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
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property int|null $file_id
 * @property bool|null $is_active
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property File|null $file
 * @property Category|null $category
 * @property Collection|Category[] $categories
 * @property Collection|Product[] $products
 * @property Collection|UserCategory[] $user_categories
 *
 * @package App\Models
 */
class Category extends Model
{
	use SoftDeletes;
	protected $table = 'categories';

	protected $casts = [
		'parent_id' => 'int',
		'file_id' => 'int',
		'is_active' => 'bool'
	];

	protected $fillable = [
		'name',
		'parent_id',
		'file_id',
		'is_active'
	];

	public function file()
	{
		return $this->belongsTo(File::class);
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'parent_id');
	}

	public function categories()
	{
		return $this->hasMany(Category::class, 'parent_id');
	}

	public function products()
	{
		return $this->hasMany(Product::class);
	}

	public function user_categories()
	{
		return $this->hasMany(UserCategory::class);
	}
}
