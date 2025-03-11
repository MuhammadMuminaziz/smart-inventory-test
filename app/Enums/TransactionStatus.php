<?php

declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TransactionStatus extends Enum
{
    const PENDING = "Pending";
    const COMPLETED = "Completed";
    const CANCELLED = "Cancelled";
}
