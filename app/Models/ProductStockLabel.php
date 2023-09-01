<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class ProductStockLabel
 * 
 * @property int $id
 * @property int $product_id
 * @property int $start_range
 * @property int $end_range
 * @property string $labels
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Product $product
 *
 * @package App\Models
 */
class ProductStockLabel extends Model
{
	use SoftDeletes;
	protected $table = 'product_stock_labels';

	protected $casts = [
		'product_id' => 'int',
		'start_range' => 'int',
		'end_range' => 'int'
	];

	protected $fillable = [
		'product_id',
		'start_range',
		'end_range',
		'labels'
	];

	public function product()
	{
		return $this->belongsTo(Product::class);
	}
}
