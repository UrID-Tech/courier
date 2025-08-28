<?php

namespace App\Enums;

enum UserType: string
{
    case SUPERADMIN = 'superadmin';
    case BUSINESS = 'business';
    case CUSTOMER = 'customer';
}
