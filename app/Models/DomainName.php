<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainName extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'domain_name',
        'user_id',
    ];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'domain_name';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
