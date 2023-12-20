<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryOption extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'price'];

    protected $searchableFields = ['*'];

    protected $table = 'delivery_options';

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
