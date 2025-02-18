<?php

namespace App\Enums;

enum StatusType: string
{
      case STARTED = 'started';
      case IN_PROGRESS = 'in_progress';
      case DONE = 'done';
      case STOPED = 'stoped';


      public function color(): string
      {
            return match ($this) {
                  self::STARTED => 'border-blue-500',
                  self::IN_PROGRESS => 'border-yellow-500',
                  self::DONE => 'border-green-500',
                  self::STOPED => 'border-red-500',
            };
      }
}
