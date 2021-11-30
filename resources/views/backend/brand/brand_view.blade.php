@extends('admin.admin_master')
@section('admin')
  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->
		<!-- Main content -->
		<section class="content">
		  <div class="row">
		
		  <!-- brand List -->
		  
		    <div class="col-8">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Brand List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Brand Eng</th>
								<th>Brand Hin</th>
								<th>Brand Ben</th>
								<th>Image</th>
                                <th>Action</th>
								
							</tr>
						</thead>
						<tbody>
						
        					@foreach($brands as $item )
							<tr>
								<td>{{$item->brand_name_en}}</td>
								<td>{{$item->brand_name_hin}}</td>
								<td>{{$item->brand_name_ben}}</td>
								<td><img src="{{asset($item->brand_image)}}" style="width:70px;height:40px;"></td>
								<td>
									<a href="{{route('brand.edit',$item->id)}}" class="btn btn-info btn-sm">
										<i class="fa fa-pencil"></i>
									</a>
									<a href="{{route('brand.delete',$item->id)}}" class="btn btn-danger btn-sm" id="delete">
									<i class="fa fa-trash"></i>
									</a>

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

			 
			  <!-- /.box -->          
			</div>
		  <!--End of brand List -->
			
		 
		  <!-- add new brand -->

			<div class="col-4">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Brand</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  
						<form method="post" action="{{route('brand.store')}}" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<h5>Brand name English</h5>
										<div class="controls">
											<input type="text" name="brand_name_en" id="brand_name_en" class="form-control"> 
											@error('brand_name_en')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
								</div>

								<div class="form-group">
									<h5>Brand name Hindi</h5>
										<div class="controls">
											<input type="text" name="brand_name_hin" id="brand_name_hin" class="form-control"> 
											@error('brand_name_hin')
												<span class="text-danger">{{$message}}</span>
											@enderror
										</div>
								</div>

								<div class="form-group">
									<h5>Brand Name Bengali</h5>
										<div class="controls">
											<input type="text" name="brand_name_ben" id="brand_name_ben" class="form-control"> 
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