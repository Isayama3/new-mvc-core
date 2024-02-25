   <li class="sidebar-item">
       <a href="{{ route('admin.home') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('Home') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.admins.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('Admins') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.roles.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('Roles') }}</span>
       </a>
   </li>
