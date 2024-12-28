<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar>
  <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
    <i class="fe fe-x"><span class="sr-only"></span></i>
  </a>
  <nav class="vertnav navbar navbar-light">
    <!-- nav bar -->
    <div class="w-100 mb-4 d-flex">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="{{route('dashboard')}}">
        <svg version="1.1" id="logo" class="navbar-brand-img brand-sm" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
          <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
          </g>
        </svg>
      </a>
    </div>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#vehicles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link" style="{{ request()->segment(1) == 'trucks' ? 'color:#1b68ff':''}}">
          <i class="fe fe-truck fe-16"></i>
          <span class="ml-3 item-main-text">المركبات</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100 {{ request()->segment(1) == ('trucks' || 'commands') ? 'show':''}}" id="vehicles">
          @can('index',\App\Models\Truck::class)

          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('trucks.index')}}"><span class="ml-1 item-text">قائمة المركبات</span></a>
          </li>
          @endcan
          @can('index',\App\Models\MovementCommand::class)

          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('commands.index')}}"><span class="ml-1 item-text">أمر حركة</span></a>
          </li>
          @endcan
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تعبئة وقود</span></a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#drivers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link " style="{{ request()->segment(1) == 'drivers' ? 'color:#1b68ff':''}}">
          <i class="fe fe-users fe-16"></i>
          <span class="ml-3 item-main-text">السائقين</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100 {{ request()->segment(1) == 'drivers' ? 'show':''}}" id="drivers" >
          @can('index',\App\Models\Driver::class)

          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('drivers.index')}}"><span class="ml-1 item-text">قائمة السائقين</span></a>
          </li>
          @endcan
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#escorts" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link " style="{{ request()->segment(1) == 'escorts' ? 'color:#1b68ff':''}}">
          <i class="fe fe-users fe-16"></i>
          <span class="ml-3 item-main-text">المرافقين</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100 {{ request()->segment(1) == 'escorts' ? 'show':''}}" id="escorts" >
          @can('index',\App\Models\Escort::class)

          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{route('escorts.index')}}"><span class="ml-1 item-text">قائمة المرافقين</span></a>
          </li>
          @endcan
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link" style="{{ request()->segment(1) == 'users' ? 'color:#1b68ff':''}}">
          <i class="fe fe-users fe-16"></i>
          <span class="ml-3 item-main-text">المستخدمين</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100 {{ request()->segment(1) == 'users' ? 'show':''}}" id="users">
          @can('index',\App\Models\User::class)

          <li class="nav-item active">
            <a class="nav-link pl-3" href="{{ route('users.index') }}"><span class="ml-1 item-text">قائمة المستخدمين</span></a>
          </li>
          @endcan
          
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#cards" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-plus-square fe-16"></i>
          <span class="ml-3 item-main-text">البطاقات</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="cards">
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('cards.index')}}"><span class="ml-1 item-text">قائمة البطاقات</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('trucks.create')}}"><span class="ml-1 item-text">بطاقة مركبة</span></a>
          </li>
          @can('create',\App\Models\Drver::class)
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('drivers.create')}}"><span class="ml-1 item-text">بطاقة سائق</span></a>
          </li>i
          @endcan
          @can('create',\App\Models\Escort::class)
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">بطاقة مرافق</span></a>
          </li>
          @endcan
          @can('create',\App\Models\User::class)
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{ route('users.create') }}"><span class="ml-1 item-text">بطاقة مستخدم</span></a>
          </li>
          @endcan
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">بطاقة تسليم مركبة</span></a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#maintenance" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-package fe-16"></i>
          <span class="ml-3 item-main-text">الصيانة</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="maintenance">
          <li class="nav-item">
          <a class="nav-link pl-3" href="{{route('maintenance_orders.index')}}"><span class="ml-1 item-text">طلبات الصيانة</span></a>
          </li>
          <li class="nav-item">
          <a class="nav-link pl-3" href="{{route('maintenance.index')}}"><span class="ml-1 item-text">أنواع الصيانة</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href="{{route('products.index')}}"><span class="ml-1 item-text">مواد الصيانة</span></a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#suppliers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fa-solid fa-parachute-box"></i>
          <span class="ml-3 item-main-text">الموردين</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="suppliers">
          <li class="nav-item">
          <a class="nav-link pl-3" href="{{route('suppliers.index')}}"><span class="ml-1 item-text">قائمة المورّدين</span></a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#orders" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-package fe-16"></i>
          <span class="ml-3 item-main-text">الطلبات</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="orders">
          <li class="nav-item">
          <a class="nav-link pl-3" href=""><span class="ml-1 item-text">قائمة الطلبات</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">طلب شراء</span></a>
          </li>
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav flex-fill w-100 mb-2">
      <li class="nav-item dropdown">
        <a href="#reports" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
          <i class="fe fe-flag fe-16"></i>
          <span class="ml-3 item-main-text">التقارير</span><span class="sr-only">(current)</span>
        </a>
        <ul class="collapse list-unstyled pl-4 w-100" id="reports">
          <li class="nav-item">
          <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تقرير إجمالي المركبات</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تقرير صيانة</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تقرير طلبات الشراء</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تقرير حركة مركبة</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تقرير حركة السائقين</span></a>
          </li>
        </ul>
      </li>
    </ul>
  </nav>
</aside>