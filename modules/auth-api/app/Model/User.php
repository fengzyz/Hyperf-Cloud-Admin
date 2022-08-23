<?php

declare (strict_types=1);

namespace App\Model;

use Hyperf\DbConnection\Model\Model;

class User extends Model{
	const CREATED_AT = 'create_time';
	
	const UPDATED_AT = 'update_time';
	
	protected ? string $dateFormat = 'U';
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected ? string $table = 'user';
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected array $fillable = [
		'user_name',
		'user_image',
		'phone',
		'sex',
	];
}