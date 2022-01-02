@extends('admin.admin_master')
@section('admin')


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



<div class="modal fade" id="compute_penalty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white">Computation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

 		 <div class="modal-body table-responsive-sm">
					  <table class="table table-bordered table-striped " style="width: 100%">
								<thead>
										<tr>
	  										<th style="color: white" width="20%">Month</th>
												<th style="color: white" width="20%">Penalty Per Day</th>
												<th style="color: white" width="20%">Total Days</th>
												<th style="color: white" width="20%">Total Amount</th>
										</tr>
								</thead>
			  					<tbody id="roll-generate-tr">

									</tbody>
						</table>
      </div>

      <div class="modal-footer">
        	<button type="submit" class="btn btn-primary"data-dismiss="modal">Close</button>
      </div>

    </div>

  </div>
</div>






 <div class="content-wrapper">
   <div class="container-full">
			<section class="content">

				 <div class="box">
						<div class="box-header with-border">
						 	 <h3 class="box-title">Unpaid Rental</h3>
						</div>

						<div class="box-body table-responsive">
								  <table id="example1" class="table table-bordered table-striped" style="width:900px !important;">
										<thead>
											<tr>
													<th width="5%" style="color: white;">SL</th>
													<th style="color: white;">Tenant</th>
													<th style="color: white;">Unpaid Month:</th>
													<th style="color: white;">Penalty</th>
											</tr>
										</thead>
										<tbody>
												@foreach($retrieve as $key => $payments)
												<tr>
														<td>{{$key+1}}</td>
														<td>{{$payments->tenant->name}}</td>

														<td>
															@foreach($merge[$key] as $number => $lastmerge)
												 					{{$merge[$key][$number]}}-
												 			@endforeach<b>
														</td>
														<td>
																<button class="btn btn-primary" onclick="handleCompute({{$payments->tenant_id}})">Compute</button> 
														</td>
												</tr>
												@endforeach
										</tbody>
							  </table>
						</div><!---BOX BODY-->
				</div><!--BOX-->
			 

		</section>
		<!-- /.content -->
	  
	  </div>
  </div>


<script type="text/javascript">
	
		function handleCompute(id){

			var id = id;

					   	 $.ajax({
	  							url: "{{ route('unpaid.rental.compute.penalty')}}",
	   								method:'GET',
	   								data:{'id':id},
	  								 dataType:'json',
	  								 success:function(data){

	  								 //$('#roll-generate').removeClass('d-none');
	   							
	   							$('#compute_penalty').modal('show')
	    							$('#roll-generate-tr').html(data.table_data);
	    							$('#exampleModalLabel').html(data.tenant_name);
	  								 }
	  								})// end of ajax
 //  

	}

</script>

@endsection