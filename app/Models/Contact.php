<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_code',
        'number',
        'person_id';
    ];

    /**
     * Relationship: A Contact belongs to a Person.
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
