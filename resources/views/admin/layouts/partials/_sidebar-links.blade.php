   <li class="sidebar-item">
       <a href="{{ route('admin.home') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.home') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.categories.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.categories') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
    <a href="{{ route('admin.clients.index') }}" class='sidebar-link'>
        <i class="bi bi-grid-fill"></i>
        <span>{{ __('admin.clients') }}</span>
    </a>
</li>
   <li class="sidebar-item">
       <a href="{{ route('admin.admins.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.admins') }}</span>
       </a>
   </li>
   <li class="sidebar-item">
       <a href="{{ route('admin.roles.index') }}" class='sidebar-link'>
           <i class="bi bi-grid-fill"></i>
           <span>{{ __('admin.roles') }}</span>
       </a>
   </li>
