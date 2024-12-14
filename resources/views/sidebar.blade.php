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
              <a href="#vehicles" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-truck fe-16"></i>
                <span class="ml-3 item-text">المركبات</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="vehicles">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('trucks.index')}}"><span class="ml-1 item-text">قائمة المركبات</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">أمر حركة</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">تعبئة وقود</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#drivers" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">السائقين</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="drivers">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href="{{route('drivers.index')}}"><span class="ml-1 item-text">قائمة السائقين</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href="{{route('drivers.create')}}"><span class="ml-1 item-text">إضافة سائق</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#users" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-users fe-16"></i>
                <span class="ml-3 item-text">المستخدمين</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="users">
                <li class="nav-item active">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">قائمة المستخدمين</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">إضافة مستخدم</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#cards" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-plus-square fe-16"></i>
                <span class="ml-3 item-text">البطاقات</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="cards">
                <li class="nav-item">
                <a class="nav-link pl-3" href=""><span class="ml-1 item-text">قائمة البطاقات</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">بطاقة مركبة</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">بطاقة تسليم مركبة</span></a>
                </li>
              </ul>
            </li>
          </ul>
          <ul class="navbar-nav flex-fill w-100 mb-2">
            <li class="nav-item dropdown">
              <a href="#orders" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
                <i class="fe fe-package fe-16"></i>
                <span class="ml-3 item-text">الطلبات</span><span class="sr-only">(current)</span>
              </a>
              <ul class="collapse list-unstyled pl-4 w-100" id="orders">
                <li class="nav-item">
                <a class="nav-link pl-3" href=""><span class="ml-1 item-text">قائمة الطلبات</span></a>
                </li>
                <li class="nav-item active">
                  <a class="nav-link pl-3" href=""><span class="ml-1 item-text">طلب صيانة</span></a>
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
                <span class="ml-3 item-text">التقارير</span><span class="sr-only">(current)</span>
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