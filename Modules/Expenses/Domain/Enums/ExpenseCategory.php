<?php

namespace Modules\Expenses\Domain\Enums;

enum ExpenseCategory: string
{
    case FOOD = 'food';
    case TRAVEL = 'travel';
    case UTILITIES = 'utilities';
    case ENTERTAINMENT = 'entertainment';
    case HEALTH = 'health';
    case OTHER = 'other';
}
