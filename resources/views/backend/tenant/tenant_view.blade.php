@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">


			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Tenant List</h3>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="15%">SL</th>
								<th>Tenant Name</th>
								<th width="15%">Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $data)
							<tr>
								<td>{{$key+1}}<input type="hidden" id="try" name="try[]" value="{{$data->name}}"></td>
								<td>{{$data->name}}</td><input type="hidden" id="second{{$key}}" name="second{{$key}}" value="{{$data->name}}">
								<td>
										<a href="{{route('tenant.edit', $data->id)}}" class="btn btn-primary"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
										</a>
										<a href="{{route('tenant.delete', $data->id)}}" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a>
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





				</div><!-- col-12-->
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>



  @endsection