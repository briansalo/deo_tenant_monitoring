 
 <!-- to get the route name and prefix-->
 @php
    $prefix = Request::route()->getprefix(); 
    $route = Request::route()->getName();   
 @endphp 


  <aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar"> 
    
        <div class="user-profile">
      <div class="ulogo">
         <a href="index.html">
          <!-- logo for regular state and mobile devices -->
           <div class="d-flex align-items-center justify-content-center">           
              <img src="../images/logo-dark.png" alt="">
              <h3><b>Deofavente</b> Admin</h3>
           </div>
        </a>
      </div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
      
    <li class="{{($route == 'dashboard')?'active':''}}">
          <a href="{{ route('dashboard')}}">
            <i data-feather="pie-chart"></i>
      <span>Dashboard</span>
          </a>
        </li>  
        <li class="treeview {{($prefix == '/users')?'active':''}}"> <!-- condition if the prefix is users then active or highlights the manage user-->
          <a href="#">
            
            <span>Tenant Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="ti-more"></i>View User</a></li>
          </ul>
        </li>

      
        <li class="treeview {{($prefix == '/setups')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Rental Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('advance.rental.payment.add')}}"><i class="ti-more"></i>Payment</a></li>
            <li><a href="{{ route('unpaid.rental.view')}}"><i class="ti-more"></i>Unpaid Rental</a></li>
            <li><a href=""><i class="ti-more"></i>Compute Penalty</a></li>

          </ul>
        </li>
      

<li class="treeview {{($prefix == '/students')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Electric Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('electricity.payment.add')}}"><i class="ti-more"></i>Payment</a></li>
            <li><a href="{{route('unpaid.electricity.view')}}"><i class="ti-more"></i>Unpaid Electricity</a></li>

          </ul>
        </li>


<li class="treeview {{($prefix == '/employee')?'active':''}} "> <!-- condition of the prefix is setups then active or highlights this-->
          <a href="#">
             <span>Deep Well Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="ti-more"></i>Employee Registration</a></li>
          </ul>
       </li>



    </section>
  
  <div class="sidebar-footer">
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
    <!-- item-->
    <a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
    <!-- item-->
    <a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
  </div>
  </aside>