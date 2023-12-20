<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Outlet extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['campus_id', 'name'];

    protected $searchableFields = ['*'];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function inventories()
    {
        return $this->belongsToMany(Inventory::class);
    }
}
