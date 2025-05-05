<?php
$url = request()->getPathInfo(); 
$items = array_filter(explode('/', $url)); 
$path = '';
$fullPath = implode('/', $items);
$customRoutes = [
    'admin/dashboard' => 'لوحة التحكم',
    'main' => 'لوحة التحكم',
    'cases/request' => 'الطلبات المعلقة',
    'cases/refined-case' => 'الطلبات المرفوضة',
    'cases/accpeted-case' => 'الحالات المقبولة',
    'cases/accpeted-case-card' => 'الحالات المفعلة',
    'cases/completed-case' => 'الحالات المكتملة',
    'projects/request' => 'طلبات المشاريع المعلقة',
    'projects/refined-request' => 'طلبات المشاريع المرفوضة',
    'projects/accpeted-request' => 'طلبات المشاريع المقبولة',
    'projects/accpeted-request-card' => 'طلبات المشاريع المفعلة',
    'projects/completed-project' => ' المشاريع المنتهية',
    'donations/reports' => ' تقارير التبرعات',
    'cases/donations' => ' تقارير الحالات',
    'organizations/reports' => ' تقارير المنظمات',
    'platform-donations' => 'دعم المنصة',
    
];
$translations = [
    'users' => 'المدراء',
    'partners' => 'الشركاء',
    'organizations' => 'المنظمات',
   'dashboard' => 'لوحة التحكم',
   'organizations-join-requests' => 'طلبات الإنضمام',
    'edit' => 'تعديل',
    'donors' => 'المتبرعين',
    'donations' => 'التبرعات',
    'notifications' => 'الإشعارات',
    'partners' => 'الشركاء',
    'partner-form' => 'إضافة شريك',
    'currencies-rate' => 'العملات',
    'system-logs' => 'احداث النظام',
    
   
];
?>
<style>
.breadcrumb-item + .breadcrumb-item::before {
  content: "│";
  font-size: 24px; 
  color: #fafcfe;
  padding: 0 0px;
  /* background-color: #f3f6f9f4; */
  
   vertical-align: middle;
  font-weight: bold;
  


  }
  .page-title {
  float: none;
  margin-top: 0;
  margin-bottom: 0;
  align-self: center;
  padding-left: 15px;

  margin-left: 15px;
  
}
.breadcrumb-flex {
  display: flex;
  align-items: center;
  flex-wrap: wrap;
  background-color: #0a041847;
}

.breadcrumb-item {
  display: flex;
  align-items: center;
  font-weight: bold;
  font-size: 16px;
  color: rgb(6, 1, 1);
}

.breadcrumb-item + .breadcrumb-item::before {
  content: "";
  display: inline-block;
  width: 1px;
  height: 24px; 
  background-color: #f6f4fa;
  margin: 0 10px;
}

  </style>
<nav aria-label="breadcrumb" style=" padding: 10px; border-radius: 5px; direction: rtl;">
    <ol class="breadcrumb mb-0 breadcrumb-flex">
        <li class="breadcrumb-item">
            <a href="/main" style="color: white;">الرئيسية</a>
        </li>

        @if (isset($customRoutes[$fullPath]))
            <li class="breadcrumb-item active" style="color: white;" aria-current="page">
                {{ $customRoutes[$fullPath] }}
            </li>
        @else
            @foreach ($items as $item)
                <?php 
                    $path .= '/' . $item;
                    $translated = $translations[$item] ?? $item; 
                ?>
                @if ($loop->last)
                    <li class="breadcrumb-item active" style="color: white;" aria-current="page">
                        {{ $translated }}
                    </li>
                @else
                    <li class="breadcrumb-item">
                        <a href="{{ $path }}" wire:navigate style="color: white;">{{ $translated }}</a>
                    </li>
                @endif
            @endforeach
        @endif
    </ol>
</nav>
