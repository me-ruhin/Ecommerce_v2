<?php
#app/Models/AdminStoreDescription.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminStoreDescription extends Model
{
    protected $primaryKey = ['lang', 'config_id'];
    public $incrementing = false;
    protected $guarded = [];
    public $timestamps = false;
    public $table = 'admin_store_description';
}
