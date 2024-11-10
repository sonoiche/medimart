<?php

namespace App\Models\Client;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "products";
    protected $guarded = [];
    protected $appends = ['created_date'];

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getCreatedDateAttribute()
    {
        $created_at = $this->attibutes['created_at'] ?? '';
        if($created_at) {
            return Carbon::parse($created_at)->format('d M, Y');
        }

        return '';
    }
}
