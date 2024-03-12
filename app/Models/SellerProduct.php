<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class SellerProduct extends Model implements HasMedia
{
    use SoftDeletes;
    use HasFactory;
    use InteractsWithMedia;

    public $table = 'seller_products';
    protected $appends = ['photo'];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'order_date',
    ];

    protected $fillable = [
        'seller_product_type_id',
        'order_date',
        'rice_percentage_one',
        'rice_percentage_two',
        'weight',
        'measurement_id',
        'total_amount',
        'price',
        'address',
        // 'media',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }
    public function sellerProductType()
        {
            return $this->belongsTo(SellerProductType::class, 'seller_product_type_id');
        }

        public function measurement()
        {
            return $this->belongsTo(Measurement::class, 'measurement_id');
        }
}
