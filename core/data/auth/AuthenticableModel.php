<?php

namespace FOXALLIES\data\auth;

use FOXALLIES\types\Authenticable;
use Illuminate\Database\Eloquent\Model;

class AuthenticableModel extends Model
{
    use Authenticable;
}
