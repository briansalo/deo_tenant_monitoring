@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
	 <div class="container-full">
	  	<section class="content">

		  	<div class="box">
						<div class="box-header with-border">
			  				<h4 class="box-title">Update Tenant</h4>
						</div><!-- /.box-header -->
			
						<div class="box-body">
								<form method="post" action="{{ route('tenant.update', $data->id)}}">
									@csrf

					 			<div class="row">
										<div class="col-md-6">
												<div class="form-group">
													<h5>Tenant Name <span class="text-danger">*</span></h5>
													<div class="controls">
														<input type="text" name="name" value="{{ $data->name}}" class="form-control" required="">
													</div>
												</div>
										</div><!-- end col md 6 -->
								 </div><!-- /.row -->

							  <div class="row">
									<div class="col-md-2">
										<input type="submit" class="btn btn-rounded btn-info" value="Update">
									</div>
								</div>

						</form>

				</div><!-- /.box-body -->	
		  </div><!-- /.box -->

		</section>
	 </div>
</div>

@endsection