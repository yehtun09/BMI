<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TodayPrice extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable=['date', 'type', 'sell_price', 'buy_price', 'rice', 'remark'];
}
