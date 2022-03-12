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
			  </div>	<!-- /.box-header -->
		
		    <div class="box-body">
			    <div class="row">
				    <div class="col">
					   <form method="post" action="{{ route('payment.store')}}">
					  	@csrf

						 <div class="row">

								<div class="col-12 col-md-4">
										<div class="form-group">
												<h5>Name <span class="text-danger"> </span></h5>
													<div class="controls">
													   <select name="select_name" id="select_name" class="form-control" aria-invalid="false" required>
															<option value="" selected="" disabled="">Select Tenant</option>
																@foreach($alltenant as $tenant)
																<option value="{{ $tenant->id }}" >{{ $tenant->name }}</option>
																@endforeach
													   </select>
													</div>   
										</div>
										<div class="form-group">
												<h5>Payment Type <span class="text-danger"> </span></h5>
													<div class="controls">
													   <select name="payment_type" id="payment_type" class="form-control" aria-invalid="false">
															<option value="1" selected="">Rental Payment</option>
															<option value="2">Electricity Payment</option>
															<option value="3">Deep Well Payment</option>
															<option value="4">Other Payment</option>
													   </select>
													</div>   
										</div>
							</div><!-- end col md 4 -->

							<div class="col-6 col-md-4">
									<div class="" id="or_number">
										<h5>OR#<span class="text-danger">*</span></h5>
											@if($or_number == 'null')
												<input type="text" name="or_number" id="or_number_null" class="form-control">
											@else
												<input type="text" name="or_number_disable" value="{{$or_number}}" class="form-control" disabled="">
												<input type="hidden" name="or_number" value="{{$or_number}}" class="form-control" >
											@endif
									</div>
									<div class="d-none" id="ar_number">
											<h5>AR#<span class="text-danger">*</span></h5>
											@if($ar_number == 'null')
												<input type="text" name="ar_number" id="ar_number_null" class="form-control">
											@else
												<input type="text" name="ar_number_disable" value="{{$ar_number}}" class="form-control" disabled="">
												<input type="hidden" name="ar_number" value="{{$ar_number}}" class="form-control" >
											@endif
						    	</div>
							</div><!-- end col md 4 -->				

							<div class="col-6 col-md-4 ">
								<h5>Status:</h5>
										<input name="status" type="radio" value="0"  id="paid"
										 class="with-gap radio-col-success" required="">
											<label for="paid">Full Payment</label><br>

										<input name="status" type="radio" value="1"  id="partial"
										 class="with-gap radio-col-primary">
											<label for="partial">Partial</label><br>

										<input name="status" type="radio" value="2"  id="cancel"
										 class="with-gap radio-col-danger">
											<label for="cancel">Cancel OR</label>
							</div>

					 </div><!-- 1st row -->

					 <div class="add_item">
						 <div class="row" id="rental">
					
								<div class="col-8 col-md-4">
									<div class="form-group">
										<h5>Month <span class="text-danger">*</span></h5>
										<div class="controls">
												<input type="month" id="month" name="month[]" class="form-control" required="">
										</div>
									</div>
								</div><!-- end col md 4 -->

						 		<div class="cold-md-1" style="padding-top:25px;">
						 			<div class="controls">
						 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
						 			</div>
						 		</div>	<!-- end col md 2 -->	
						 
							</div> <!--end row -->
					</div><!--additem-->

					 <div class="row d-none" id="electric">
				
							<div class="col-md-4">
									<div class="form-group">
										<h5>From: <span class="text-danger">*</span></h5>
											<div class="controls">
												<input type="date" name="from" id="from" class="form-control">
											</div>
									</div>
							</div><!-- end col md 6 -->

							<div class="col-md-4">
								<div class="form-group">
									<h5>To: <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="date" name="to" id="to" class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->

						</div><!-- end row-->

					 <div class="row d-none" id="water">
							<div class="col-md-4">
								<div class="form-group">
									<h5>From <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="month" id="from_water" name="from_water" class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->
							<div class="col-md-4">
								<div class="form-group">
									<h5>To <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="month" id="to_water" name="to_water" class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->
						</div> <!--end row -->

					 <div class="row d-none" id="other">
							<div class="col-md-4">
								<div class="form-group">
									<h5>Details <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" id="details_other" name="details_other" class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->
						</div> <!--end row -->
						@error('month')
						asd
						@enderror

					  <div class="row">
							<div class="col-md-2">
								<input type="submit" class="btn btn-rounded btn-info" value="submit" id="submit">
							</div>
					</div>
		    </form><!--form-->

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
 </div><!--content wrapper-->

<!-------for jquery in month field---------->
  <div style="visibility: hidden;">
  	<div class="whole_extra_item_add" id="whole_extra_item_add">
  		<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
  			<div class="row">

							<div class="col-8 col-md-4">
								<div class="form-group">
									<h5>Month <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="month" name="month[]"  class="form-control">
							  	</div>
							  </div>
							</div><!-- end col md 4 -->

					 		<div class="col-3 cold-md-2" style="padding-top:25px;">
					 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
					 				<span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i>	</span>
					 		</div>	<!-- end col md 2 -->	

  			</div><!--row-->
  		</div>
  	</div>	
  </div>



<script type="text/javascript">

	$('#select_name').select2();

///-----------------------on click event-----------------------////
	$(document).on("click",".addeventmore",function(){
		 		var whole_extra_item_add = $('#whole_extra_item_add').html();
 			$(".add_item").append(whole_extra_item_add);
	});


	$(document).on("click",'.removeeventmore',function(){
 			$('#delete_whole_extra_item_add').remove();
 			
 		});


$("#submit").click(function(){
		//check if radio is checked or not
		var radio_status = $("input[name='status']:checked").val();
			if(radio_status == null){
				window.alert("please select status");
			}
});

///-----------------------on change event-----------------------////

//payment_type
$("#payment_type").change(function() {

	  if ($(this).val() == "1") { //for rental payment
				  $('#rental').removeClass('d-none');
				  $('#electric').addClass('d-none');
				  $('#water').addClass('d-none');
				  $('#other').addClass('d-none');

				  $('#or_number').removeClass('d-none');
				  $('#or_number_null').attr('required',true);
				  $('#ar_number').addClass('d-none');
				  $('#ar_number_null').removeAttr('required');

				 	var radio_status = $("input[name='status']:checked").val();
					if(radio_status != 2){
				 		 $('#month').attr('required',true);
				  }
				  $('#from').removeAttr('required');
				  $('#to').removeAttr('required');
				  $('#from_water').removeAttr('required');
				  $('#to_water').removeAttr('required');
				  $('#details_other').removeAttr('required');
	  }

	   if ($(this).val() == "2") { //for electricity payment

				  $('#electric').removeClass('d-none');
				  $('#rental').addClass('d-none');
	    		$('#water').addClass('d-none');
	    		$('#other').addClass('d-none');

				  $('#ar_number').removeClass('d-none');
				  $('#ar_number_null').attr('required',true);
				  $('#or_number').addClass('d-none');
				  $('#or_number_null').removeAttr('required');

				 	var radio_status = $("input[name='status']:checked").val();
					if(radio_status != 2){
						  $('#from').attr('required',true);
						  $('#to').attr('required',true);
					}
				  $('#month').removeAttr('required');
				  $('#from_water').removeAttr('required');
				  $('#to_water').removeAttr('required');
				  $('#details_other').removeAttr('required');

	  }

	   if ($(this).val() == "3") { //for water payment
	    		$('#water').removeClass('d-none');
				  $('#electric').addClass('d-none');
				  $('#rental').addClass('d-none');
				  $('#other').addClass('d-none');

				  $('#or_number').removeClass('d-none');
				  $('#or_number_null').attr('required',true);
				  $('#ar_number').addClass('d-none');
				  $('#ar_number_null').removeAttr('required');

				 	var radio_status = $("input[name='status']:checked").val();
					if(radio_status != 2){
						  $('#from_water').attr('required',true);
						  $('#to_water').attr('required',true);
				  }
				  $('#from').removeAttr('required');
				  $('#to').removeAttr('required');
				  $('#month').removeAttr('required');
				  $('#details_other').removeAttr('required');
	   }

	   if ($(this).val() == "4") { //for other payment
	    		$('#other').removeClass('d-none');
				  $('#electric').addClass('d-none');
				  $('#rental').addClass('d-none');
				  $('#water').addClass('d-none');

				  $('#or_number').removeClass('d-none');
				  $('#or_number_null').attr('required',true);
				  $('#ar_number').addClass('d-none');
				  $('#ar_number_null').removeAttr('required');

				 	var radio_status = $("input[name='status']:checked").val();
					if(radio_status != 2){
						  $('#details_other').attr('required',true);
				  }
				  $('#from').removeAttr('required');
				  $('#to').removeAttr('required');
				  $('#month').removeAttr('required');
				  $('#from_water').removeAttr('required');
				  $('#to_water').removeAttr('required');
	   }

});


//status
$("input[name='status']").change(function(){

		if($( this ).val()==0 || $( this ).val()==1 ){
				$('#payment_type').attr('required', true); 
				$('#select_name').attr('required', true);
		}

		if($( this ).val()==2){
				$('#select_name').removeAttr('required');
				$('#payment_type').removeAttr('required');  
				$('#month').removeAttr('required');
				$('#from').removeAttr('required');  
				$('#to').removeAttr('required');  
			  $('#from_water').removeAttr('required');
			  $('#to_water').removeAttr('required');
			  $('#details_other').removeAttr('required');
		}

});


</Script>
@endsection