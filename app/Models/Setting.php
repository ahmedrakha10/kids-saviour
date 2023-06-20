<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasFactory, HasTranslations;

    protected $casts = [
        'description' => 'array',
        'title'       => 'array',
    ];

    public $translatable = ['description', 'title'];

    public function vips()
    {
        return $this->morphMany(Image::class, 'imageable')->whereType('vip');
    }

    public function specials()
    {
        return $this->morphMany(Image::class, 'imageable')->whereType('special');
    }

    public function normals()
    {
        return $this->morphMany(Image::class, 'imageable')->whereType('normals');
    }
}
