<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Idea extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    /**
     * Idea belongs to User
     *
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Idea belongs to Category
     *
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Idea belongs to Status
     *
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Idea status color
     *
     */
    public function getStatusClasses()
    {

        $allStatuses = [
            'Open'          => 'bg-gray-200',
            'Considering'   => 'bg-purple text-white',
            'In Progress'   => 'bg-yellow text-white',
            'Implemented'   => 'bg-green text-white',
            'Closed'        => 'bg-red text-white',
        ];

        return $allStatuses[$this->status->name];
    }
}
