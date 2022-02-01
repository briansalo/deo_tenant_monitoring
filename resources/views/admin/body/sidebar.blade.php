 
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
               <a href="#">
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
                    <a href="#">
                      <i data-feather="pie-chart"></i>
                        <span>Dashboard</span>
                    </a>
              </li>  

              <li class="treeview {{($prefix == '/tenant')?'active':''}}"> 
                  <a href="#">
                    <span>Tenant</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="{{($route == 'tenant.view')?'active':''}}">
                          <a href="{{ route('tenant.view')}}"><i class="ti-more"></i>View Tenant
                          </a>
                      </li>
                      <li class="{{($route == 'tenant.add')?'active':''}}">
                          <a href="{{ route('tenant.add')}}"><i class="ti-more"></i>Add Tenant
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="treeview {{($prefix == '/manage')?'active':''}}"> <!-- condition if the prefix is users then active or highlights the manage user-->
                <a href="#">               
                  <span>Management</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-right pull-right"></i>
                  </span>
                </a>
                  <ul class="treeview-menu">
                      <li class="{{($route == 'official.receipt.view' or $route == 'payment.edit')?'active':''}}">
                          <a href="{{ route('official.receipt.view')}}"><i class="ti-more"></i>Official Receipt Record
                          </a>
                      </li>
                      <li class="{{($route == 'acknowledge.receipt.view' or $route == 'payment.edit')?'active':''}}">
                          <a href="{{ route('acknowledge.receipt.view')}}"><i class="ti-more"></i>Acknowledge Receipt Record
                          </a>
                      </li>
                      <li class="{{($route == 'payment.add')?'active':''}}">
                          <a href="{{ route('payment.add')}}"><i class="ti-more"></i>Payment
                          </a>
                      </li>
                  </ul>
              </li>

              <li class="treeview {{($prefix == '/unpaid_bill')?'active':''}}"> 
                  <a href="#">
                    <span>Unpaid Bill</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="{{($route == 'unpaid.rental.view')?'active':''}}">
                        <a href="{{ route('unpaid.rental.view')}}"><i class="ti-more active"></i>Unpaid Rental
                        </a>
                      </li>
                      <li class="{{($route == 'unpaid.electricity.view')?'active':''}}">
                        <a href="{{route('unpaid.electricity.view')}}"><i class="ti-more"></i>Unpaid Electricity
                        </a>
                      </li>
                      <li class="{{($route == 'unpaid.deepwell.view')?'active':''}}">
                        <a href="{{route('unpaid.deepwell.view')}}"><i class="ti-more"></i>Unpaid Deep Well
                        </a>
                      </li>
                  </ul>
              </li>

              <li class="treeview {{($prefix == '/to_do_list')?'active':''}}"> 
                  <a href="#">
                    <span>To-Do Things</span> <span class="badge  rounded-pill alert-danger font-weight-bold">{{$count_todo}}</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                      <li class="{{($route == 'to_do.add')?'active':''}}">
                        <a href="{{ route('to_do.add')}}"><i class="ti-more active"></i>To Do Add
                        </a>
                      </li>
                      <li class="{{($route == 'to_do.view')?'active':''}}">
                        <a href="{{route('to_do.view')}}"><i class="ti-more"></i>To Do List
                        </a>
                      </li>
                  </ul>
              </li>

          </ul>
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