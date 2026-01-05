<?php 

namespace App\Laravel\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class Guardian extends Model{
	
	use SoftDeletes;

	protected static function boot()
    {
        parent::boot();

        static::creating(function ($model){
            $model->connection = config('database.default');
        });
    }
	
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "guardians";

	/**
	 * The database connection used by the model.
	 *
	 * @var string
	 */
	// protected $connection = "reader_db";

	/**
	 * Enable soft delete in table
	 * @var boolean
	 */
	protected $softDelete = true;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [];


	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = [];

	/**
	 * The attributes that created within the model.
	 *
	 * @var array
	 */
	protected $appends = [];

	protected $dates = [];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
	];
}