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
			 			 <h4 class="box-title">Update Acknowledgement Receipt Record</h4>
					</div>

				<div class="box-body">

					<form method="post" action="{{ route('acknowledge.receipt.update', $acknowledge_receipt[0]->ar_number)}}">
						@csrf

					 <div class="row">

							<div class="col-md-4">
								<div class="form-group">
									<h5>Name <span class="text-danger"> </span></h5>
										<div class="controls">
										   <select name="select_name" id="select_name" class="form-control" aria-invalid="false" required>
												<option value="" selected="" disabled="">Select Tenant</option>
													@foreach($alltenant as $tenant)
													<option value="{{ $tenant->id }}"
															{{(!empty($acknowledge_receipt[0]->tenant->id) and $acknowledge_receipt[0]->tenant->id == $tenant->id)
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
												<option value="2"{{($acknowledge_receipt[0]->billing_id == 2)?'selected':''}}>Electricity Payment</option>
										   </select>
										</div>   
								</div>
							</div><!-- end col md 4 -->

							<div class="col-md-4">
								<div class="form-group">
									<h5>AR#<span class="text-danger">*</span></h5>
									<div class="controls">
										<input type="text" name="or_number_disable" value="{{$acknowledge_receipt[0]->ar_number}}" class="form-control" disabled="">
										<input type="hidden" name="or_number" value="{{$acknowledge_receipt[0]->ar_number}}" class="form-control" >
				
									</div>
								</div>
							</div><!-- end col md 4 -->							

							<div class="col-md-4 ">
								<h5>Status:</h5>
									<div class="form-group">
												<input name="status" type="radio" value="0"  id="paid"
												 class="with-gap radio-col-success"  {{($acknowledge_receipt[0]->status == 0)?'checked':''}}>
													<label for="paid">Full Payment</label><br>

												<input name="status" type="radio" value="1"  id="partial"
												 class="with-gap radio-col-primary" {{($acknowledge_receipt[0]->status == 1)?'checked':''}}>
													<label for="partial">Partial</label><br>

												<input name="status" type="radio" value="2"  id="cancel"
												 class="with-gap radio-col-danger" {{($acknowledge_receipt[0]->status == 2)?'checked':''}}>
													<label for="cancel">Cancel OR</label>
									</div>
							</div><!--col md 4-->

					</div><!-- /.row -->

					 <div class="row" id="electric">
				
								<div class="col-md-4">
									<div class="form-group">
										<h5>From <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="date" name="from" id="from" value="{{$acknowledge_receipt[0]->start_date}}"class="form-control"required>
										</div>
									</div>
								</div><!-- end col md 4 -->

								<div class="col-md-4">
									<div class="form-group">
										<h5>To <span class="text-danger">*</span></h5>
										<div class="controls">
											<input type="date" name="to" id="to" value="{{$acknowledge_receipt[0]->end_date}}" class="form-control" required="">
										</div>
									</div>
								</div><!-- end col md 4 -->

						</div><!-- end row-->


					 <div class="row">
							<div class="col-md-2">
								<input type="submit" class="btn btn-rounded btn-info" value="Update">
							</div>
					 </div>

				</form><!--form-->

			</div><!-- /.box-body -->
	  </div><!-- /.box -->
		  
 	</section>
 </div>
</div>



<script>

	$('#select_name').select2();
			 $("input[name='status']").change(function(){

				var value = $( this ).val();  // get the value that been changed
				if($( this ).val()==2){
					$('#select_name').removeAttr('required'); 
					$('#month').removeAttr('required');
					$('#from').removeAttr('required');  
					$('#to').removeAttr('required');  
				}

				});

</script>
@endsection