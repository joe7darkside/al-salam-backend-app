<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Notification extends Model
{
    use HasFactory;


    use HasFactory;
    protected $fillable = ['title_en', 'title_ar', 'description_en', 'description_ar', 'admin_id'];


    /** 
     * The attributes that should be cast to native types.
     *
     * @var array
     */

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
