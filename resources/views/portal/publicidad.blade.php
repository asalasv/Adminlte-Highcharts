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
				<div class="box-footer">
		            <label for="exampleInputFile"><i class="fa fa-edit"></i>Actualizar Imagen de Publicidad</label>
                    <input type="file" class="form-control" name="publicidad">
				</div>
			</div>
		</div>
</div>
@endsection
