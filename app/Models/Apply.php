<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_register',
        'status_id',
        'document_id',
        'is_archived',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    public function scopeSearch($query, array $searches)
    {
        return $query->join('documents', 'applies.document_id', '=', 'documents.id')
            ->when($searches['search'] ?? false, function($query, $search) {
                return $query->where('applies.no_register', 'like', "%$search%")
                    ->orWhere('documents.first_name', 'like', "%$search%")
                    ->orWhere('documents.family_name', 'like', "%$search%")
                    ->orWhere('documents.email', 'like', "%$search%")
                    ->orWhere('documents.department', 'like', "%$search%")
                    ->orWhere('documents.nationality', 'like', "%$search%");
            });
    }
}
