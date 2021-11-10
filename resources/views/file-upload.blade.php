@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('File Manager') }}</div>

                <div class="card-body">
                	<input type="text" name="search" class="search form-control" placeholder="Search" />
                	<table id="table" class="table" style="margin-top: 25px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>    
                        <tbody id="table-body">
	                            @php
	                                $count = 1;
	                            @endphp
	                            @foreach($allfiles as $file)
	                                <tr>
	                                    <td>{{ $count }}</td>
	                                    <td>{{ $file->name }}</td>
	                                    <td><a style="color:black" href="{{ route('delete', ['id' => $file->id]) }}"><i class="fas fa-trash" style="color:red;"></i></a></td>
	                                </tr>

	                                @php
	                                    $count++;
	                                @endphp

	                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
            			{!! $allfiles->links() !!}
        			</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('File Upload') }}</div>

                <div class="card-body">
                	<form action="{{route('fileUpload')}}" method="post" enctype="multipart/form-data">
                		@csrf

                		@if ($message = Session::get('success'))
				            <div class="alert alert-success">
				                <strong>{{ $message }}</strong>
				            </div>
			          	@endif
	                	@if (count($errors) > 0)
				            <div class="alert alert-danger">
				                <ul>
				                    @foreach ($errors->all() as $error)
				                      <li>{{ $error }}</li>
				                    @endforeach
				                </ul>
				            </div>
				        @endif

				        <div class="custom-file">
			                <input type="file" name="file" class="custom-file-input" id="chooseFile">
			                <label class="custom-file-label" for="chooseFile">Select file</label>
			            </div>

			            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
			                Upload Files
			            </button>
                    
                </div>
            </div>
        </div>
    </div><br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Deleted Files') }}</div>

                <div class="card-body">
                	<table id="table" class="table" style="margin-top: 25px;">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                            </tr>
                        </thead>    
                        <tbody id="table-body">
	                            @php
	                                $count = 1;
	                            @endphp
	                            @foreach($dfiles as $dfile)
	                                <tr>
	                                    <td>{{ $count }}</td>
	                                    <td>{{ $dfile->name }}</td>
	                                </tr>

	                                @php
	                                    $count++;
	                                @endphp

	                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
            			{!! $dfiles->links() !!}
        			</div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            
        </div>
    </div>
</div>


@endsection
