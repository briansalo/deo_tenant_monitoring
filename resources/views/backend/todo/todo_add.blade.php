@extends('admin.admin_master')
@section('admin')

<div class="content-wrapper">
	<div class="container-full">
    	<section class="content">

		  	<div class="box">
				<div class="box-header with-border">
			  		<h4 class="box-title">Add Todo</h4>
				</div><!-- /.box-header -->
			
				<div class="box-body">
					<form method="post" action="{{ route('to_do.store')}}">
						@csrf

		 			<div class="row">
						<div class="col-md-5">
							<div class="form-group">
								<h5>Task <span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="task" class="form-control" required="">
								</div>
							</div>
						</div><!-- end col md 6 -->
					 </div><!-- /.row -->

					  <div class="row">
							<div class="col-md-2">
								<input type="submit" class="btn btn-rounded btn-info" value="Submit">
							</div>
					</div>

					</form>

				</div><!-- /.box-body -->	
		  </div><!-- /.box -->

		</section>
	 </div>
</div>

@endsection