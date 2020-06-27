<?php


namespace TanerInCode\Fonzip\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Vkovic\LaravelCustomCasts\HasCustomCasts;

class Ngo extends Model
{
    use SoftDeletes;
    use HasCustomCasts;

    protected $guarded = ['id'];
}
