<?php

namespace App\Enums;

enum Currency: string
{
    case YER = 'ريال يمني';
    case SAR = 'ريال سعودي';
    case USD = 'دولار أمريكي';
}