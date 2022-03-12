@extends('admin.admin_master')
@section('admin')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<div class="content-wrapper">
  <div class="container-full">
	  <section class="content">
		  <div class="box">
				<div class="box-header with-border">
				  <h4 class="box-title">Payment</h4>
				</div> <!-- /.box-header -->
			
					<div class="box-body">

						 <form method="post" action="{{ route('official.receipt.update', $official_receipt[0]->or_number)}}">
					   @csrf

			      <div class="row">

				  		<div class="col-12 col-md-4">
						  		<div class="form-group">
										<h5>Name <span class="text-danger"> </span></h5>
											<div class="controls">
											   <select name="select_name" id="select_name" class="form-control" aria-invalid="false" required>
													<option value="" selected="" disabled="">Select Tenant</option>
														@foreach($alltenant as $tenant)
														<option value="{{ $tenant->id }}"
																{{(!empty($official_receipt[0]->tenant->id) and $official_receipt[0]->tenant->id == $tenant->id)
																?'selected': ''}} >
																{{ $tenant->name }}
														</option>
														@endforeach
											   </select>
											</div>   
							  	</div>
								  <div class="form-group">
										<h5>Payment Type <span class="text-danger"> </span></h5>
											<div class="controls">
											   <select name="payment_type" id="payment_type" class="form-control" aria-invalid="false" required>
													<option value="1"{{($official_receipt[0]->billing_id == 1)?'selected':''}}>Rental Payment</option>
													<option value="3"{{($official_receipt[0]->billing_id == 3)?'selected':''}}>Deep Well Payment</option>
													<option value="4"{{($official_receipt[0]->billing_id == 4)?'selected':''}}>Other Payment</option>
											   </select>
											</div>   
								  </div>
							</div><!-- end col md 4 -->

							<div class="col-6 col-md-4">
							  <div class="form-group">
								  <h5>OR#<span class="text-danger">*</span></h5>
									<div class="controls">
											<input type="text" name="or_number_disable" value="{{$official_receipt[0]->or_number}}" class="form-control" disabled="">
											<input type="hidden" name="or_number" value="{{$official_receipt[0]->or_number}}" class="form-control" >
									</div>
							  </div>
							</div><!-- end col md 4 -->							

							<div class="col-6 col-md-4" >
								<h5>Status:</h5>
									<div class="form-group">
												<input name="status" type="radio" value="0"  id="paid"
												 class="with-gap radio-col-success"  {{($official_receipt[0]->status == 0)?'checked':''}}>
													<label for="paid">Full Payment</label><br>

												<input name="status" type="radio" value="1"  id="partial"
												 class="with-gap radio-col-primary" {{($official_receipt[0]->status == 1)?'checked':''}}>
													<label for="partial">Partial</label><br>

												<input name="status" type="radio" value="2"  id="cancel"
												 class="with-gap radio-col-danger" {{($official_receipt[0]->status == 2)?'checked':''}}>
													<label for="cancel">Cancel OR</label>
									</div>
						  </div><!--col md 4-->

					 </div><!-- /.row -->


					 <div class="add_item">
						 	@foreach($official_receipt as $key => $or)
							 	<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
									 <div class="row d-none" id="rental{{$key}}">
									 		<!---this input type for jquery-->
											<input type="hidden" name="count" id="count" value="{{count($official_receipt)}}">

											<div class="col-9 col-md-4">
												<div class="form-group">
													<h5>Month <span class="text-danger">*</span></h5>
														<div class="controls">
																<input type="month" id="month{{$key}}" 
																value="{{ ($or->month == null)?
																'': date('Y-m', strtotime($or->month))
																 }}"
																  name="month[]" class="form-control">
														</div>
												</div>
											</div><!-- end col md 6 -->

									 		<div class="col-3 cold-md-2" style="padding-top:25px;">
									 				<span class="btn btn-success addeventmore"><i class="fa fa-plus-circle" ></i></span>
									 				<span class="btn btn-danger removeeventmore"><i class="fa fa-minus-circle"></i>	</span>
									 		</div>	<!-- end col md 2 -->	
									 
										</div> <!--end row -->
							</div>
					  	@endforeach
					</div><!--additem-->

					 <div class="row d-none" id="water">
				
							<div class="col-md-4">
								<div class="form-group">
									<h5>From <span class="text-danger">*</span></h5>
									<div class="controls">
											<input type="month" name="from" id="from" 
											value="{{ ($official_receipt[0]->start_date==null)?
											'':date('Y-m', strtotime($official_receipt[0]->start_date))
											 }}"class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->

							<div class="col-md-4">
								<div class="form-group">
									<h5>To <span class="text-danger">*</span></h5>
									<div class="controls">
									<input type="month" name="to" id="to" 
										value="{{ ($official_receipt[0]->end_date==null)?
											'':date('Y-m', strtotime($official_receipt[0]->end_date))
											 }}" class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->

					</div><!-- end row-->

					 <div class="row d-none" id="other">
							<div class="col-md-4">
								<div class="form-group">
									<h5>Details <span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" id="details_other" name="details_other" value="{{$official_receipt[0]->details}}"
										 class="form-control">
									</div>
								</div>
							</div><!-- end col md 6 -->
						</div> <!--end row -->

					<div class="row">
						<div class="text-xs-right">
							<input type="submit" class="btn btn-rounded btn-info" value="submit" id="submit">
						</div>
					</div>
			</form><!--form-->


			</div>	<!-- /.box-body -->
		  </div>	<!-- /.box -->
  	</section>
  </div>
 </div>


<!-------for jquery in month field---------->
  <div style="visibility: hidden;">
  	<div class="whole_extra_item_add" id="whole_extra_item_add">
  		<div class="delete_whole_extra_item_add" id="delete_whole_extra_item_add">
  			<div class="row">

							<div class="col-9 col-md-4">
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


var count =$("#count").val();	// this variable to use the for loop


	// in case we have two or more month field in rental. we need to for loop in order to d-none or see all the month field
	for (let i = 0; i < count; i++) {
			//jquery show field depend of the value of payment_type
			var payment =$("#payment_type").val();
			if(payment=="1"){
						  $('#rental'+i).removeClass('d-none');
						  $('#water').addClass('d-none');
						  $('#other').addClass('d-none');

						  $('#month').attr('required',true);
						  $('#from').removeAttr('required');
						  $('#to').removeAttr('required');
						  $('#details_other').removeAttr('required');
			}

			if(payment=="3"){
						  $('#water').removeClass('d-none');
						  $('#rental').addClass('d-none');
						  $('#other').addClass('d-none');

						  $('#from').attr('required',true);
						  $('#to').attr('required',true);
						  $('#month').removeAttr('required');
						  $('#details_other').removeAttr('required');
			}

			if(payment=="4"){
						  $('#other').removeClass('d-none');
						  $('#rental').addClass('d-none');
						  $('#water').addClass('d-none');

						  $('#details_other').attr('required',true);
						  $('#from').removeAttr('required');
						  $('#to').removeAttr('required');
						  $('#month').removeAttr('required');
			}
	}//ENDFOR


///-----------------------on change event-----------------------////
//payment type change
$("#payment_type").change(function() {
		for (let i = 0; i < count; i++) {

				  if ($(this).val() == "1") {
							  $('#rental'+i).removeClass('d-none');
							  $('#water').addClass('d-none');

							 	var radio_status = $("input[name='status']:checked").val();
								if(radio_status != 2){
							 		 $('#month').attr('required',true);
							  }
							  $('#from').removeAttr('required');
							  $('#to').removeAttr('required');
				  }

				  if ($(this).val() == "3") {
							  $('#water').removeClass('d-none');
							  $('#rental'+i).addClass('d-none');

							 	var radio_status = $("input[name='status']:checked").val();
								if(radio_status != 2){
									  $('#from').attr('required',true);
									  $('#to').attr('required',true);
							  }

							  $('#month').removeAttr('required');
				 }
		 }//end for 
});


//status change
$("input[name='status']").change(function(){

		var value = $( this ).val();
			if($( this ).val()==2){
					$('#select_name').removeAttr('required');
					$('#month').removeAttr('required');
					$('#from').removeAttr('required');  
					$('#to').removeAttr('required');
					$('#details_other').removeAttr('required');  
		  }

});



</script>

@endsection