<?php

namespace App\Entities;

use CodeIgniter\Entity;
use Fluent\Auth\Contracts\AuthenticatorInterface;
use Fluent\Auth\Contracts\HasAccessTokensInterface;
use Fluent\Auth\Facades\Hash;
use Fluent\Auth\Traits\AuthenticatableTrait;
use Fluent\Auth\Traits\HasAccessTokensTrait;

class User extends Entity implements
    AuthenticatorInterface,
    HasAccessTokensInterface
{
    use AuthenticatableTrait;
    use HasAccessTokensTrait;

    /**
     * Fill set password hash.
     *
     * @return $this
     */
    public function setPassword(string $password)
    {
        $this->attributes['password'] = Hash::make($password);

        return $this;
    }
}
