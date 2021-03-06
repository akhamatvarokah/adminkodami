@extends('layout.main')

@section('title', 'Admin Koperasi Dana Masyarakat Indonesia')

@section('content')

	<div class="row bg-title">
       <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			<h4 class="page-title">Dashboard 1</h4>
       </div>
       <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
			<button class="right-side-toggle waves-effect waves-light btn-info btn-circle pull-right m-l-20"><i class="ti-settings text-white"></i></button>
				<a href="{{ URL('vendor') }}" class="btn btn-success btn-sm pull-right m-l-20 hidden-xs hidden-sm waves-effect waves-light" target="_top"> <i class="fa fa-back"></i> BACK VENDOR</a>
				<ol class="breadcrumb">
					<li><a href="javascript:void(0)">Dashboard</a></li>
					<li class="active">Dashboard</li>
				</ol>
       	</div>
       <!-- /.col-lg-12 -->
    </div>

	<div class="row">
	   	<div class="col-sm-12">
	      	<div class="white-box">
				<h3 class="box-title">Form Vendor Intern</h3>
				<form class="form-horizontal" method="POST" action="{{ URL("vendor") }}">
					@csrf

						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Email:</label>
							<div class="col-sm-9">
								<input type="email" name="email" class="form-control" id="email" placeholder="Email">
							</div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="name">Nama Vendor:</label>
						    <div class="col-sm-9">
						      <input type="name" class="form-control" id="name" name="name" placeholder="Nama Vendor">
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="pic_name">Pic Name:</label>
						    <div class="col-sm-9">
						      <input type="name" class="form-control" id="pic_name" name="pic_name" placeholder="Nama PIC Name">
						    </div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="username">User Name Login:</label>
						    <div class="col-sm-9">
						      <input type="username" class="form-control" id="username" name="username" placeholder="User Name">
						    </div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="telephone">Phone Number:</label>
							<div class="col-sm-9">
								<input type="text" name="telephone" class="form-control" id="telephone" placeholder="Telephone">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="province">Province Warehouse:</label>
							<div class="col-sm-9">
								<select name="province" class="form-control" id="province">
									<option value="">--Silahkan Pilih Province--</option>
									@foreach($province as $key => $value)
										<option value="{{ $value->id }}">{{ $value->name }}</option>
									@endForeach
								</select>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="regency">Regency Warehouse:</label>
							<div class="col-sm-9">
								<select name="regency" class="form-control" id="regency">
									
								</select>
							</div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3" for="kode_pos">Kode Pos:</label>
						    <div class="col-sm-9">
						      <input type="text" class="form-control" id="kode_pos" name="kode_pos" placeholder="Kode Pos">
						    </div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="detail_address">Detail Alamat Warehouse:</label>
							<div class="col-sm-9">
								<textarea  class="form-control" name="detail_address" id="detail_address"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="slogan">Slogan:</label>
							<div class="col-sm-9">
								<textarea  class="form-control" name="slogan" id="slogan"></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="deskripsi">Deskripsi:</label>
							<div class="col-sm-9">
								<textarea  class="form-control" name="deskripsi" id="deskripsi"></textarea>
							</div>
						</div>

						<div class="form-group">
						    <label class="control-label col-sm-3">primary Image :</label>
						    <div class="col-sm-5">
						    	<div id="dropzone" class="dropzone"></div>
						    </div>
						</div>

						<div id="image">
						
						</div>

						<div class="form-group">
							<label class="control-label col-sm-3" for="password">Password:</label>
							<div class="col-sm-9">
								<input class="form-control" type="password" name="password" id="password">
							</div>
						</div>

						<div class="form-group">							
							<div class="col-sm-12">
								<button style="float: right;" type="submit" class="btn btn-primary">Save</button>
							</div>
						</div>

				</form>
			</div>
	   </div>
	</div>

@endsection

@section('script')
	<script>
	    $(function() {
	    	$("#province").select2();
	    	$("#regency").select2();

	    	$("#province").change(function(){
	    		$.ajax({
	    			type: "GET",
					url: "{{ URL('place/getAjaxRegency') }}",
					data : {'province_id' : $(this).val()},
					dataType: 'json',
					success: function(data){
						$("#regency").html("");
						$.each(data, function(key, val){
							$("#regency").append("<option value='"+val.id+"'>"+val.name+"</option>");
						});
					}
	    		})
	    	})

	    	 $("#dropzone").dropzone({ 
	            url: "{{ URL('upload/image') }}", 
	            maxFiles: 1,
	            paramName: "image", 
	            addRemoveLinks: true,
	            sending: function(file, xhr, formData) {
    				formData.append("_token", "{{ csrf_token() }}");
				},
				removedfile: function(file) {
				    $("#"+file.upload.uuid).remove();
				    file.previewElement.remove();
			    },
				success: function (file, response) {
					$("#image").append($("<input id='"+file.upload.uuid+"' value='"+response+"' type='hidden' name='image' >"));
	            }
	        });
		});
	</script>
@endsection