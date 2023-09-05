<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use phpseclib3\File\ASN1\Maps\Attribute;

/**
 * Class Product
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $category_id
 * @property float $price
 * @property int|null $quantity
 * @property bool $is_featured
 * @property bool $is_popular
 * @property bool $is_new_arrival
 * @property bool $is_top_selling
 * @property bool|null $is_discounted_deal
 * @property bool $is_active
 * @property int|null $thumbnail_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Category $category
 * @property File|null $file
 * @property Collection|CartDetail[] $cart_details
 * @property Collection|OrderDetail[] $order_details
 * @property Collection|ProductImage[] $product_images
 * @property Collection|ProductStockLabel[] $product_stock_labels
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
		'quantity' => 'int',
		'is_featured' => 'bool',
		'is_popular' => 'bool',
		'is_new_arrival' => 'bool',
		'is_top_selling' => 'bool',
		'is_discounted_deal' => 'bool',
		'is_active' => 'bool',
		'thumbnail_id' => 'int'
	];

	protected $fillable = [
		'name',
		'description',
		'category_id',
		'price',
		'quantity',
		'is_featured',
		'is_popular',
		'is_new_arrival',
		'is_top_selling',
		'is_discounted_deal',
		'is_active',
		'thumbnail_id'
	];

    protected $appends = [
//        'is_wishlisted',
//        'label',
    ];
//    public function getLabelAttribute()
//    {
//        if (is_null(ProductStockLabel::select('labels')
//            ->where('product_id', $this->id)
//            ->where(function ($q){
//                $q->where('start_range', '<=', $this->stock )
//                    ->where('end_range', '>=', $this->stock );
//            })
//            ->first())){
//            if ($this->stock > 0){
//                return ['labels'=>'In Stock'];
//            }
//        }
//
//        if ($this->stock == 0){
//            return ['labels' => 'Out of Stock'];
//        }
//
//        return ProductStockLabel::select('labels')
//            ->where('product_id', $this->id)
//            ->where(function ($q){
//                $q->where('start_range', '<=', $this->stock )
//                    ->where('end_range', '>=', $this->stock );
//            })
//            ->first();
//    }



    public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function file()
	{
		return $this->belongsTo(File::class, 'thumbnail_id');
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

	public function product_stock_labels()
	{
		return $this->hasMany(ProductStockLabel::class);
	}

}
