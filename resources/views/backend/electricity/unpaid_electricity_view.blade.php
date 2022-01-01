@extends('admin.admin_master')
@section('admin')



 <div class="content-wrapper">
	  <div class="container-full">
			<section class="content">

			 	<div class="box">
						<div class="box-header with-border">
					  	<h3 class="box-title">Unpaid Electricity</h3>
						</div>

						<div class="box-body">

					  		<table id="example1" class="table table-bordered table-striped">
									<thead>
										<tr>
											<th style="color: white;" width="5%">SL</th>
											<th style="color: white;">Tenant</th>
											<th style="color: white;">Last Payment</th>
										</tr>
									</thead>
									<tbody>
										@foreach($alldata as $key => $data)
										<tr>
							    			<td>{{$key+1}}</td>
											<td>{{$data->tenant->name}}</td>
											<td>
												 {{$get_latest_date[$key]}}
											</td>
							       	    </tr>
										@endforeach
									</tbody>
					  		</table>
		
						</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->
		</section>
	</div>
</div>




@endsection