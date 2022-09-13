<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $table = 'deliveries';

    public $timestamps = true;

    protected $fillable = [
        'title', 'description', 'deadline', 'completed'
    ];

    public static function search($filters = null)
    {
        $query = Delivery::query();

        if($filters['title']){
            $query->where('title', 'LIKE', "%{$filters['title']}%");
        }
        if($filters['completed']){
            $query->where('completed', "%{$filters['completed']}%");
        }
        if($filters['date_start']){
            $query->where('deadline', '>=', "%{$filters['date_start']}%");
        }
        if($filters['date_end']){
            $query->where('deadline', '<=', "%{$filters['date_end']}%");
        }

        $results = $query->get();

        return $results;
    }

}
