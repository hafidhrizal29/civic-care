<?php

namespace App\Models;

use Database\Factories\ComplaintFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Complaint extends Model
{
    /** @use HasFactory<ComplaintFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'complaints';

    protected $fillable = [
        'complaint_category_id',
        'nomor_tiket',
        'judul',
        'nama_pelapor',
        'email',
        'telepon',
        'lokasi',
        'deskripsi',
        'foto',
        'status',
    ];

    protected $attributes = [
        'status' => 'baru',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ComplaintCategory::class, 'complaint_category_id');
    }

    public function responses(): HasMany
    {
        return $this->hasMany(Response::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Complaint $complaint) {
            if (empty($complaint->nomor_tiket)) {
                $complaint->nomor_tiket = static::generateTicketNumber();
            }
        });
    }

    public static function generateTicketNumber(): string
    {
        $prefix = 'CC-'.now()->format('Ymd');
        $lastComplaint = static::withTrashed()
            ->where('nomor_tiket', 'like', "{$prefix}%")
            ->latest('id')
            ->value('nomor_tiket');

        if ($lastComplaint) {
            $sequence = (int) substr($lastComplaint, -4) + 1;
        } else {
            $sequence = 1;
        }

        return $prefix.'-'.str_pad((string) $sequence, 4, '0', STR_PAD_LEFT);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%")
                    ->orWhere('nama_pelapor', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        return $query;
    }

    public function scopeStatus(Builder $query, ?string $status): Builder
    {
        if ($status) {
            return $query->where('status', $status);
        }

        return $query;
    }

    public function scopeCategory(Builder $query, ?int $categoryId): Builder
    {
        if ($categoryId) {
            return $query->where('complaint_category_id', $categoryId);
        }

        return $query;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'baru' => 'Baru',
            'diproses' => 'Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
            default => ucfirst($this->status),
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'baru' => 'blue',
            'diproses' => 'amber',
            'selesai' => 'green',
            'ditolak' => 'red',
            default => 'gray',
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'baru' => 'bg-blue-50 text-blue-700',
            'diproses' => 'bg-amber-50 text-amber-700',
            'selesai' => 'bg-green-50 text-green-700',
            'ditolak' => 'bg-red-50 text-red-700',
            default => 'bg-gray-50 text-gray-700',
        };
    }
}
