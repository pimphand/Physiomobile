<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medium_acquisition'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to search patients by user information.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $searchTerm
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch(Builder $query, ?string $searchTerm): Builder
    {
        if (!$searchTerm) {
            return $query;
        }

        return $query->where(function ($q) use ($searchTerm) {
            $q->whereHas('user', function ($q2) use ($searchTerm) {
                $q2->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('id_no', 'like', "%{$searchTerm}%")
                    ->orWhere('address', 'like', "%{$searchTerm}%");
            })->orWhere('medium_acquisition', 'like', "%{$searchTerm}%");
        });
    }
}
