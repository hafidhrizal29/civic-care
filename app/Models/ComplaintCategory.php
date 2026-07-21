<?php

namespace App\Models;

use Database\Factories\ComplaintCategoryFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplaintCategory extends Model
{
    /** @use HasFactory<ComplaintCategoryFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'complaint_categories';

    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function complaints(): HasMany
    {
        return $this->hasMany(Complaint::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where('nama', 'like', "%{$search}%")
                ->orWhere('deskripsi', 'like', "%{$search}%");
        }

        return $query;
    }
}
