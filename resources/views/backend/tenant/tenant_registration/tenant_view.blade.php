@extends('admin.admin_master')
@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>




<!-- ///////////////////////////////////////////////////Create Modal////////////////////////////////////////// -->

<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white">Register Tenant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<form method="post" action="{{ route('tenant.store')}}">
	@csrf

  <div class="modal-body">
   
  	<div class="form-group">
				<h5>Business Name <span class="text-danger">*</span></h5>
						<div class="controls">
								<input type="text" name="business_name"  class="form-control">
								<div class="help-block">									
								</div>
						</div>
	  	</div>

  	<div class="form-group">
				<h5>Name of Owner<span class="text-danger">*</span></h5>
						<div class="controls">
								<input type="text" name="owner_name"  class="form-control">
								<div class="help-block">									
								</div>
						</div>
 		</div>

<h5>Date of Contract <span class="text-danger">*</span></h5>
  <div class="form-row">
    <div class="col">
      <input type="date" name="from"  class="form-control">
    </div>
    <div class="col">
      <input type="date" name="to"  class="form-control">
    </div>
  </div>

    	<div class="form-group">
				<h5>Gross Amount<span class="text-danger">*</span></h5>
						<div class="controls">
								<input type="text" name="amount"  class="form-control">
								<div class="help-block">									
								</div>
						</div>
  		</div> 

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

       </form>
    </div>

  </div>
</div>





<!-- ///////////////////////////////////////////////////Edit Modal////////////////////////////////////////// -->


<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="color: white">Register Tenant</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<form method="post" action="{{ route('tenant.edit')}}">
	@csrf

  <div class="modal-body">
   
  	<div class="form-group">
				<h5>Business Name <span class="text-danger">*</span></h5>
						<div class="controls">
								<input type="text" name="business_name" id="business_name" class="form-control">
								<div class="help-block">									
								</div>
						</div>
	  	</div>

  	<div class="form-group">
				<h5>Name of Owner<span class="text-danger">*</span></h5>
						<div class="controls">
								<input type="text" name="owner_name" id="owner_name"class="form-control">
								<div class="help-block">									
								</div>
						</div>
 		</div>

<h5>Date of Contract <span class="text-danger">*</span></h5>
  <div class="form-row">
    <div class="col">
      <input type="date" name="from" id="from" class="form-control">
    </div>
    <div class="col">
      <input type="date" name="to" id="to" class="form-control">
    </div>
  </div>

    	<div class="form-group">
				<h5>Gross Amount<span class="text-danger">*</span></h5>
						<div class="controls">
								<input type="text" name="amount" id="gross" class="form-control">
								<div class="help-block">									
								</div>
						</div>
  		</div> 

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>

       </form>
    </div>

  </div>
</div>




/////////////////////////////////////////////// table //////////////////////////////////////////////////////////////
  <div class="content-wrapper">
	  <div class="container-full">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-12">


			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Tenant List</h3>
				  <span class="btn btn-success float-right" data-toggle="modal" data-target="#create"><i class="fa fa-plus-circle">
				  Create New Tenant</i></span>

				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th width="5%">SL</th>
								<th>Tenant Name</th>
								<th>Business Owner</th>
								<th>Date of Contract</th>
								<th>Gross Amount</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($alldata as $key => $data)
							<tr>
								<td>{{$key+1}}<input type="hidden" id="try" name="try[]" value="{{$data->name}}"></td>
								<td>{{$data->name}}</td><input type="hidden" id="second{{$key}}" name="second{{$key}}" value="{{$data->name}}">
								<td>{{$data->owner}}</td>
								<td>From: {{$data->from}} &nbsp;&nbsp;To: {{$data->to}}</td>
								<td>{{$data->gross}}</td>
								<td>
								<button type="button" class="btn btn-primary"  onclick="handleEdit({{$data->id}})">Edit</button>
									<span class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></span>
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





				</div><!-- col-12-->
			</div>
		</section>
		<!-- /.content -->
	  </div>
  </div>


<script type="text/javascript">

	function handleEdit(id){

			var id = id;

					   	 $.ajax({
	  							url: "{{ route('tenant.edit')}}",
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