@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


 <div class="content-wrapper">
	  <div class="container-full">
			<section class="content" id="for_desktop">
		 	 <div class="row">
				  <div class="col-12">

						 <div class="box">
								<div class="box-header with-border">
								  	<h3 class="box-title">Official Receipt Record </h3>
								</div><!-- /.box-header -->

								
									<div class="box-body table-responsive">
									  <table id="example2" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th style="color: white;">OR#</th>
													<th style="color: white;">Tenant</th>
													<th style="color: white;">Bill</th>
													<th style="color: white;">Month</th>
													<th style="color: white;">Status</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
												@foreach($allrecord as $record)
													<tr>
														<td>{{$record->or_number}}</td>

														@if($record->tenant_id == 0)
															<td>cancel</td>
														@else
															<td>{{$record->tenant->name}}</td>
														@endif

														@if($record->billing_id ==1)
															<td>Rental</td>
														@elseif($record->billing_id ==3)
															<td>Deep Well</td>
														@else
															<td>Other</td>
														@endif
										
														@if($record->billing_id == 1)
															<td>
																{{ \Carbon\Carbon::parse($record->month)->format('F Y')}}
															</td>
														@elseif($record->billing_id==3)
															<td>
																{{ \Carbon\Carbon::parse($record->start_date)->format('Y F')}} 1  - {{ \Carbon\Carbon::parse($record->end_date)->format('Y F')}} 30
															</td>
														@else
															<td>{{$record->details}}</td>	
														@endif

														@if($record->status == 0)
															<td>Paid</td>
														@elseif($record->status == 1)
															<td bgcolor="blue" style="color: white;">Partial</td>
														@else
															<td bgcolor="red" style="color: white;">Cancel</td>
														@endif

														<td>
															<a href="{{ route('official.receipt.edit', $record->or_number)}}" class="btn btn-primary">Edit</a>
														</td>
													</tr>
												@endforeach
											</tbody>

									  </table>
									</div>
								
							<!-- /.box-body -->
						  </div>
						  <!-- /.box -->


		  	</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
  </div>
</div>

<!--jquery to make it responsive-->
<script>
$(document).ready(function() {
    // This will fire when document is ready:
    $(window).resize(function() {
        // This will fire each time the window is resized:
        if($(window).width() >= 1024) {
            // if larger or equal
            $("#for_desktop").attr('class', 'content');
        } else {
            // if smaller
            $("#for_desktop").attr('class', '');
        }
    }).resize(); // This will simulate a resize to trigger the initial run.
});
</script>
@endsection