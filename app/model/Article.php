<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Article extends Model
{
    //
    protected $table = "tu_article";

    public function category(){
        return $this->hasOne(Category::class,"id","category_id");
    }
}
