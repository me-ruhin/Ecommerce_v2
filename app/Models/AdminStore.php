<?php
#app/Models/AdminStore.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminStore extends Model
{
    public $timestamps = false;
    public $table = 'admin_store';
    protected $guarded = [];
    protected static $getAll = null;
    
    public function descriptions()
    {
        return $this->hasMany(AdminStoreDescription::class, 'config_id', 'id');
    }
    public static function getData($id = 1)
    {
        if (self::$getAll == null) {
            self::$getAll = self::with('descriptions')->find($id);
        }
        return self::$getAll;
    }
}
