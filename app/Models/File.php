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
 * Class File
 *
 * @property int $id
 * @property string $name
 * @property string $s3_key
 * @property string $local_path
 * @property string $type
 * @property string|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property Collection|Category[] $categories
 * @property Collection|ProductImage[] $product_images
 *
 * @package App\Models
 */
class File extends Model
{
	use SoftDeletes;
	protected $table = 'files';
    protected $appends = ['url'];


    public function getUrlAttribute()
    {
        $type = config('file')['types'][$this->type];
        $acl = $type['acl'] ?? 'public';
        if ($this->local_path) {
            return url($this->local_path);
        }
        return $acl === 'public';
    }
    const TYPE_PRODUCT_IMAGE = "PRODUCT_IMAGE";
    const TYPE_PRODUCT_CATEGORY = "CATEGORY";


	protected $fillable = [
		'name',
		's3_key',
		'local_path',
		'type'
	];

	public function categories()
	{
		return $this->hasMany(Category::class);
	}

	public function product_images()
	{
		return $this->hasMany(ProductImage::class);
	}
}
