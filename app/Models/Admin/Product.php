<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use softDeletes;
    //protected $table = 'produtos';
    //protected $primaryKey = 'chave';
    //protected $incremeting = false;
    //protected $keyType = 'string';
    //public $timestamps = false;
    //protected $connection - 'sqlite';
    protected $dates = ['created_at', 'updated_at', 'published_at', 'deleted_at'];

    protected $fillable = [
        'name',
        'number',
        'category',
        'active',
        'description',
    ];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('publushed', function(Builder $builder){
        //     $builder->where('published_at', '!=', "");
        // });
    }

    public function getActiveFormattedAttribute()
    {
        return $this->active?'Sim':'Não';
    }

    public function setNumberAttribute($value)
    {
        $this->attributes['number'] =
                preg_replace('/[^0-9]/', '', $value);
    }

    public function scopeInformatica($query)
    {
        return $query->where('category', 'informatica');
    }
    
    public function scopeOfType($query, $type)
    {
        return $query->where('category', $type);
    }











}
