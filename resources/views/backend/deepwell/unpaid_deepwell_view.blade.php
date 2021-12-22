@extends('admin.admin_master')
@section('admin')



 <div class="content-wrapper">
	<div class="container-full">
		<section class="content">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Unpaid Deep Well</h3>
				</div>

				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Tenant</th>
								<th>Unpaid Month</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $data)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$data->tenant->name}}</td>
								<td>
									@foreach($unpaid_month[$key] as $number => $lastmerge)
									 	{{$unpaid_month[$key][$number]}}-
									 @endforeach<b>
								</td>
							</tr>
							@endforeach
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			 </div>
			  <!-- /.box -->
	 </section>
  </div>
</div>




@endsection