<?php


namespace TanerInCode\Fonzip\Models;


use App\Models\Ngo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use Vkovic\LaravelCustomCasts\HasCustomCasts;

class Donation extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];
}
