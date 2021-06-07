<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;
    use HasFactory;
    protected $guarded=[];
    protected $table ='settings';

    public $translatable = ['title','address1','address2','desc','footer_desc','terms_condition','privacy_policy','about_app'];


//    public function getArAboutAppAttribute($value)
//    {
//        return strip_tags($value);
//    }
//
//    public function getArTermsConditionAppAttribute($value)
//    {
//        return strip_tags($value);
//    }


}
