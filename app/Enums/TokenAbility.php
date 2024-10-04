<?php

namespace App\Enums;

enum TokenAbility: string
{
    case SUPER_ADMIN = '*';
    case PROFILE_USER = 'profile-user';
    case FINANCIAL_USER = 'financial-user';
    // Add more abilities as needed
}