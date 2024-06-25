<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAttachment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uploaded_user_id', 'attachmentable_id', 'url', 'state', 'label', 'file', 'content_type', 'user','attachmentable_type'
    ];

    // Relationships
    public function uploadedUser()
    {
        return $this->belongsTo(User::class, 'uploaded_user_id');
    }

  // Define the polymorphic relationship
  public function attachmentable()
  {
      return $this->morphTo();
  }
}
