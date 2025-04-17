<?php

namespace App\Enums;

enum OrganizationStatus: string
{
    case WAITING = 'waiting';
    case IN_PROGRESS = 'in_progress';
    case PAUSED = 'paused';
    case COMPLETED = 'completed';


    //   public function color(): string
    //   {
    //         return match ($this) {
    //               self::STARTED => 'border-blue-500',
    //               self::IN_PROGRESS => 'border-yellow-500',
    //               self::DONE => 'border-green-500',
    //               self::STOPED => 'border-red-500',
    //         };
    //   }
}
