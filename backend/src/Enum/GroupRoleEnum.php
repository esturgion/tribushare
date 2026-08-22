<?php

namespace App\Enum;

enum GroupRoleEnum: string
{
    case MEMBER = 'member';
    case OWNER = 'owner';
}