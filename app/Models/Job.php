<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    public $fillable=['title','description','min_experience','max_experience','min_salary','max_salary','apply_url',
    'expiration_date'
];
public function getRouteKeyName() {
    return 'title';
  }
}
