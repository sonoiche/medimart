<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScanObject extends Model
{
    use HasFactory;

    protected $table = "scan_objects";
    protected $guarded = [];
}
