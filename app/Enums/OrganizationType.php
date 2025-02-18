<?php

namespace App\Enums;

enum OrganizationType: string
{
      case SOCIAL = 'اجتماعي';
      case HEALTH = 'صحي';
      case EDUCATION = 'تعليمي';
      case RELIEF = 'إغاثي';
      case ORPHANS = 'رعاية الأيتام';
      case FOOD = 'توزيع الغذاء';
      case WATER = 'توفير المياه';
      case HOUSING = 'بناء المساكن';
      case RELIGIOUS = 'ديني';
      case ECONOMIC = 'تمكين اقتصادي';
}
