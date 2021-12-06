@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>



  <div class="content-wrapper">
	  <div class="container-full">

	  	<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Electricity Payment</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('electricity.payment.store')}}">
						@csrf

					 <div class="row">


							<div class="col-md-4">
							<div class="form-group">
									<h5>Name <span class="text-danger"> </span></h5>
										<div class="controls">
										   <select name="select_name" id="select_name"  required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select Name</option>
													@foreach($alltenant as $tenant)
													<option value="{{ $tenant->id }}" >{{ $tenant->name }}</option>
													@endforeach
										   </select>
										</div>   
							</div>
							</div><!-- end col md 6 -->



							<div class="col-md-4">
							<div class="form-group">
								<h5>OR#<span class="text-danger">*</span></h5>
								<div class="controls">
									<input type="text" name="or_number"  class="form-control">
								</div>
							</div>
							</div><!-- end col md 6 -->							

					 </div><!-- /.row -->

					 <div class="row">
				
							<div class="col-md-4">
								<div class="form-group">
									<h5>From <span class="text-danger">*</span></h5>
									<div class="controls">
									<input type="date" name="from"  class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->

							<div class="col-md-4">
								<div class="form-group">
									<h5>To <span class="text-danger">*</span></h5>
									<div class="controls">
									<input type="date" name="to"  class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->

						</div><!-- end row-->


					  <div class="row">
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="submit">
						</div>
					</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
	  </div>
  </div>





@endsection