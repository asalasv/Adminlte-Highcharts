@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')

<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">Publicidad</div>

				<div class="panel-body">
					<img src={{$publicidad}} alt="..." class="img-rounded center-block">
				</div>
				{!! Form::open (['route'=> ['portal/publicidad'], 'method' => 'POST', 'class'=>'form-horizontal','files'=>true, 'enctype'=>'multipart/form-data']) !!}
				<div class="box-footer">
					
		            <label for="exampleInputFile"><i class="fa fa-edit"></i>Actualizar Imagen de Publicidad</label>
                    <div class="row">
                    	<div class="col-xs-4">
	                    	<input type="file" class="form-control" name="publicidad">
	                    </div>
	                    <div class="col-xs-4">
	                    	<button type="submit" class="btn btn-success"><i class="fa fa-upload"></i></button>
						</div>
					</div>
				</div>
				{!! Form::close()!!}
			</div>
		</div>
</div>
@endsection
