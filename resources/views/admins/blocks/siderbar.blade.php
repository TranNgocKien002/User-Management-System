   <!-- ========== Menu ========== -->
   <div class="app-menu">

       <!-- Brand Logo -->
       <div class="logo-box">
           <!-- Brand Logo Light -->
           <a href="index.html" class="logo-light">
               <img src="{{ asset('assets/admins/images/logo-light.png') }}" alt="logo" class="logo-lg">
               <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="small logo" class="logo-sm">
           </a>

           <!-- Brand Logo Dark -->
           <a href="index.html" class="logo-dark">
               <img src="{{ asset('assets/admins/images/logo-dark.png') }}" alt="dark logo" class="logo-lg">
               <img src="{{ asset('assets/admins/images/logo-sm.png') }}" alt="small logo" class="logo-sm">
           </a>
       </div>

       <!-- menu-left -->
       <div class="scrollbar">

           <!-- User box -->
           <div class="user-box text-center">
               <img src="{{ asset('assets/admins/images/users/user-1.jpg') }}" alt="user-img" title="Mat Helme"
                   class="rounded-circle avatar-md">
               <div class="dropdown">
                   <a href="javascript: void(0);" class="dropdown-toggle h5 mb-1 d-block"
                       data-bs-toggle="dropdown">Geneva Kennedy</a>
                   <div class="dropdown-menu user-pro-dropdown">

                       <!-- item-->
                       <a href="javascript:void(0);" class="dropdown-item notify-item">
                           <i class="fe-user me-1"></i>
                           <span>My Account</span>
                       </a>

                       <!-- item-->
                       <a href="javascript:void(0);" class="dropdown-item notify-item">
                           <i class="fe-settings me-1"></i>
                           <span>Settings</span>
                       </a>

                       <!-- item-->
                       <a href="javascript:void(0);" class="dropdown-item notify-item">
                           <i class="fe-lock me-1"></i>
                           <span>Lock Screen</span>
                       </a>

                       <!-- item-->
                       <a href="javascript:void(0);" class="dropdown-item notify-item">
                           <i class="fe-log-out me-1"></i>
                           <span>Logout</span>
                       </a>

                   </div>
               </div>
               <p class="text-muted mb-0">Admin Head</p>
           </div>

           <!--- Menu -->
           <ul class="nav flex-column menu ps-3">
               <li class="nav-item"><a href="/dashboard" class="nav-link">🏠 Dashboard</a></li>

               <li class="nav-header">User Management</li>
               <li class="nav-item"><a href="/users" class="nav-link">👥 All Users</a></li>
               <li class="nav-item"><a href="/users/create" class="nav-link">➕ Add New</a></li>
               <li class="nav-item"><a href="/users/deactivated" class="nav-link">🚫 Deactivated</a></li>
               <li class="nav-item"><a href="/roles" class="nav-link">🔐 Roles</a></li>

               <li class="nav-header">Admin</li>
               <li class="nav-item"><a href="/admins" class="nav-link">🛡️ Admin Accounts</a></li>
               <li class="nav-item"><a href="/profile" class="nav-link">👤 My Profile</a></li>

               <li class="nav-header">Logs</li>
               <li class="nav-item"><a href="/logs" class="nav-link">📝 Activity Logs</a></li>
           </ul>

           <!--- End Menu -->
           <div class="clearfix"></div>
       </div>
   </div>
   <!-- ========== Left menu End ========== -->
