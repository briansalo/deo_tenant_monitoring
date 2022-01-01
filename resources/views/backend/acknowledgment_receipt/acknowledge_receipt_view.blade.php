@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


 <div class="content-wrapper">
	  <div class="container-full">
			<section class="content">
		 	 <div class="row">
				  <div class="col-12">

						 <div class="box">
								<div class="box-header with-border">
								  	<h3 class="box-title">Acknowledgement Receipt Record</h3>
								</div><!-- /.box-header -->

								<div class="box-body">
									<div class="">
									  <table id="example2" class="table table-bordered table-striped">
											<thead>
												<tr>
													<th style="color: white;">AR#</th>
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
						                                <td>{{$record->ar_number}}</td>
						                                @if($record->tenant_id == 0)
						                                    <td>cancel</td>
						                                @else
						                                    <td>{{$record->tenant->name}}</td>
						                                @endif

						                                @if($record->billing_id ==2)
						                                    <td>Electric</td>
						                                @else
						                               	     <td></td>
						                                @endif
						            

						                                @if($record->billing_id==2)
						                                    <td>From:{{$record->start_date}} To:{{$record->end_date}}</td>  
						                                @endif

						                                @if($record->status == 0)
						                                    <td>Paid</td>
						                                @elseif($record->status == 1)
						                                    <td bgcolor="blue" style="color: white;">Partial</td>
						                                @else
						                                    <td bgcolor="red" style="color: white;">Cancel</td>
						                                @endif

						                                <td>
						                                    <a href="{{ route('acknowledge.receipt.edit', $record->ar_number)}}" class="btn btn-primary">Edit</a>
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


		  	</div>
			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
  </div>
</div>


@endsection