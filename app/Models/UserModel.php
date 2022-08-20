<?php

namespace App\Models;

use CodeIgniter\Model;
use Fluent\Auth\Contracts\UserProviderInterface;
use App\Entities\User;
use Fluent\Auth\Traits\UserProviderTrait;

class UserModel extends Model implements UserProviderInterface
{
    use UserProviderTrait;

    /**
     * Name of database table
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The format that the results should be returned as.
     * Will be overridden if the as* methods are used.
     *
     * @var User
     */
    protected $returnType = User::class;

    /**
     * An array of field names that are allowed
     * to be set by the user in inserts/updates.
     *
     * @var array
     */
    protected $allowedFields = [
        'email',
        'username',
        'password',
        'remember_token',
    ];

    /**
     * If true, will set created_at, and updated_at
     * values during insert and update routines.
     *
     * @var boolean
     */
    protected $useTimestamps = true;
}