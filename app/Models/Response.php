<?php

namespace App\Models;

use Database\Factories\ResponseFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Response extends Model
{
    /** @use HasFactory<ResponseFactory> */
    use HasFactory;

    protected $table = 'responses';

    protected $fillable = [
        'complaint_id',
        'user_id',
        'isi',
    ];

    public function complaint(): BelongsTo
    {
        return $this->belongsTo(Complaint::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if ($search) {
            return $query->whereHas('complaint', function ($q) use ($search) {
                $q->where('nomor_tiket', 'like', "%{$search}%")
                    ->orWhere('judul', 'like', "%{$search}%");
            })->orWhere('isi', 'like', "%{$search}%");
        }

        return $query;
    }

    protected static function booted(): void
    {
        static::created(function (Response $response) {
            $complaint = $response->complaint;

            if ($complaint && $complaint->status === 'baru') {
                $complaint->update(['status' => 'diproses']);
            }
        });
    }
}
