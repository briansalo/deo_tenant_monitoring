@extends('admin.admin_master')
@section('admin')



 <div class="content-wrapper">
	<div class="container-full">
		<section class="content">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">To Do List</h3>
				</div>

				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Task</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $data)
							<tr>
								<td>{{$key+1}}</td>
								<td>{{$data->task}}</td>
								<td>
								<a href="{{route('to_do.delete', $data->id)}}" class="btn btn-primary"><i class="fa fa-check-square-o" aria-hidden="true"></i></a>
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