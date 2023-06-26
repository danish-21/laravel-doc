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
 * Class Product
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $category_id
 * @property float $price
 * @property int|null $quantity
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Collection|CartDetail[] $cart_details
 * @property Collection|OrderDetail[] $order_details
 * @property Collection|ProductImage[] $product_images
 *
 * @package App\Models
 */
class Product extends Model
{
	use SoftDeletes;
	protected $table = 'products';

	protected $casts = [
		'category_id' => 'int',
		'price' => 'float',
		'quantity' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'category_id',
		'price',
		'quantity'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function cart_details()
	{
		return $this->hasMany(CartDetail::class);
	}

	public function order_details()
	{
		return $this->hasMany(OrderDetail::class);
	}

	public function product_images()
	{
		return $this->hasMany(ProductImage::class);
	}
}
