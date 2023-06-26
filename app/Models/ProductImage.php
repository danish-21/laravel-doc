<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductImage
 * 
 * @property int $id
 * @property int $product_id
 * @property int $file_id
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property File $file
 * @property Product $product
 *
 * @package App\Models
 */
class ProductImage extends Model
{
	use SoftDeletes;
	protected $table = 'product_images';

	protected $casts = [
		'product_id' => 'int',
		'file_id' => 'int'
	];

	protected $fillable = [
		'product_id',
		'file_id'
	];

	public function file()
	{
		return $this->belongsTo(File::class);
	}

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
