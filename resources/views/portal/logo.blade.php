@extends('layouts.app')

@section('htmlheader_title')
Home
@endsection


@section('main-content')

<div class="row">

		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading text-center">Logo</div>

				<div class="panel-body">
					<img src="img/photo1.png" alt="..." class="img-rounded center-block">
				</div>
				<div class="box-footer">
		            <label for="exampleInputFile">Actualizar Imagen de Logo</label>
                    <input type="file" class="form-control" name="publicidad">
				</div>
			</div>
		</div>

</div>
@endsection
