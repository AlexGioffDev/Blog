<?php

namespace App;

enum UserRole: string
{
    case ADMIN = 'ADMIN';
    case MOD = 'MOD';
    case USER = 'USER';
}
