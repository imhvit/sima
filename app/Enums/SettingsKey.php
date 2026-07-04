<?php

namespace App\Enums;

enum SettingsKey: string
{
    case STOCK_MINIMUM = 'stock_minimum';
    case COMPANY_NAME = 'company_name';
    case CURRENCY = 'currency';
}
