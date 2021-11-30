@extends('admin.admin_master')
@section('admin')
  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
		  <div class="row">
		
		  <!-- brand List -->
		  
		 <!--End of brand List -->
			
		 
		  <!-- add new brand -->

			<div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Edit Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  
						<form method="post" action="{{route('brand.update',$brand->id)}}" enctype="multipart/form-data">
								@csrf
                                <input type="hidden" name="id" value="{{$brand->id}}">
                                <input type="hidden" name="old_image" value="{{$brand->brand_image}}">

								<div class="form-group">
									<h5>Brand name English</h5>
										<div class="controls">
											<input type="text" name="brand_name_en" id="brand_name_en" class="form-control" value="{{$brand->brand_name_en}}"> 
											@error('brand_name_en')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
								</div>

								<div class="form-group">
									<h5>Brand name Hindi</h5>
										<div class="controls">
											<input type="text" name="brand_name_hin" id="brand_name_hin" class="form-control"  value="{{$brand->brand_name_hin}}"> 
											@error('brand_name_hin')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
								</div>

								<div class="form-group">
									<h5>Brand Name Bengali</h5>
										<div class="controls">
											<input type="text" name="brand_name_ben" id="brand_name_ben" class="form-control"  value="{{$brand->brand_name_ben}}"> 
											@error('brand_name_ben')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
								</div>

								<div class="form-group">
									<h5>Brand Image</h5>
										<div class="controls">
											<input type="file" name="brand_image" class="form-control"> 
											@error('brand_image')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
								</div>

								<div class="text-xs-right">
									<input type="Submit" class="btn btn-rounded btn-primary mb-5" value="Update">  
								</div>
                		</form>


					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->

			 
			  <!-- /.box -->          
			</div>

			<!-- End of add new brand -->

			<!-- /.col -->
		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->
	  
	  </div>
  
  <!-- /.content-wrapper -->

@endsection