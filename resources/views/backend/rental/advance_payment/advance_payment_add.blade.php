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
			  <h4 class="box-title">Payment</h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
					<form method="post" action="{{ route('advance.rental.payment.store')}}">
						@csrf

					 <div class="row">


							<div class="col-md-4">
							<div class="form-group">
									<h5>Name <span class="text-danger"> </span></h5>
										<div class="controls">
										   <select name="select_name" id="select_name"  required="" class="form-control" aria-invalid="false">
												<option value="" selected="" disabled="">Select Tenant</option>
												<option value="cancel">Cancel OR</option>
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
									<input type="text" name="or_number_disable" value="{{$or_number}}" class="form-control" disabled="">
								</div>
							</div>
							</div><!-- end col md 6 -->							

					 </div><!-- /.row -->

					 <div class="add_item">
					 <div class="row">
				
							<div class="col-md-4">
								<div class="form-group">
									<h5>Month <span class="text-danger">*</span></h5>
									<div class="controls">
									<input type="month" name="month[]"  class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->

					 		<div class="cold-md-2" style="padding-top:25px;">
					 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
					 		</div>	<!-- end col md 2 -->	
					 
						</div> <!--end row -->
					</div>



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





  <div style="visibility: hidden;">
  	<div class="whole_extra_item_add" id="whole_extra_item_add">
  		<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
  			<div class="row">

					 		
							<div class="col-md-4">
								<div class="form-group">
									<h5>Month <span class="text-danger">*</span></h5>
									<div class="controls">
									<input type="month" name="month[]"  class="form-control">
								</div>
							</div>
							</div><!-- end col md 6 -->


					 		<div class="cold-md-2" style="padding-top:25px;">
					 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
					 				<span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i>	</span>
					 		</div>	<!-- end col md 2 -->	

					 


  			</div>
  		</div>
  	</div>	
  </div>



<script type="text/javascript">

	$('#select_name').select2();

	$(document).on("click",".addeventmore",function(){

		 		var whole_extra_item_add = $('#whole_extra_item_add').html();
 			$(".add_item").append(whole_extra_item_add);

	});

	$(document).on("click",'.removeeventmore',function(){
 			$('#delete_whole_extra_item_add').remove();
 			
 		});

</script>
@endsection