<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="wrap-division">
					@foreach($fotografias as $foto)
					<div class="col-md-4 col-sm-4 animate-box">
						<div class="tour">
							<a class="tour-img" style="background-image: url(storage/noticia/{{ $foto->nombrefotografia }});" data-toggle="modal" data-target="#modal1" onclick="getPath(this)" alt="error"></a>
						</div>
					</div>
					@endforeach

				</div>
			</div>
			<br><br>
		</div>
	</div>
</div>

<div class="row text-center">
	<div class="col-md-12">
		{!!$fotografias->links()!!}
	</div>
</div>