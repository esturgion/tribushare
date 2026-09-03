<?php

namespace App\Enum;

enum TribeRoleEnum: string
{
    case MEMBER = 'member';
    case ADMIN = 'admin';
    case OWNER = 'owner';
}
