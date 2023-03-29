<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['item_cat_name','item_cat_desc','is_parent','parent_id'];
    
    public static function shiftChild($cat_id){
        Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }
    public static function getChildByParentId($id){
        return Category::where('parent_id',$id)->pluck('item_cat_name','id');
    }
}
