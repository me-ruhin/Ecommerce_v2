<?php
#app/Modules/Cms/Models/Content/CmsCategoryDescription.php
namespace App\Plugins\Modules\Cms\Content\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CmsCategoryDescription extends Model
{
    protected $primaryKey = ['lang', 'category_id'];
    public $incrementing  = false;
    protected $guarded    = [];
    public $timestamps    = false;
    public $table         = 'cms_category_description';

//=========================

    public function uninstall()
    {
        if (Schema::hasTable($this->table)) {
            Schema::drop($this->table);
        }
    }

    public function install()
    {
        $return = ['error' => 0, 'msg' => 'Install modules success'];
        if (!Schema::hasTable($this->table)) {
            try {
                Schema::create($this->table, function (Blueprint $table) {
                    $table->integer('category_id');
                    $table->string('lang', 10);
                    $table->string('title', 200)->nullable();
                    $table->string('keyword', 200)->nullable();
                    $table->string('description', 200)->nullable();
                    $table->primary(['category_id', 'lang']);
                });
            } catch (\Exception $e) {
                $return = ['error' => 1, 'msg' => $e->getMessage()];
            }
        } else {
            $return = ['error' => 1, 'msg' => 'Table ' . $this->table . ' exist!'];
        }
        return $return;
    }

}
