@section('content')
	<div class="column-holder" role="main">
		<h1>Fotogallerij</h1>
		<p class="delta">Krijg een impressie van de meest geweldige studentenvereniging zus en zo en bla die bla. En zus en zo!</p>
		<div class="albums">
			<div class="photo-grid-row">
				<div class="photo-tile first">
					<a href="fotos.html" class="photo-link" title="{{ $albums[0]->name }}">
						<img src="{{ $albums[0]->smallImage() }}" alt="{{ $albums[0]->name }}" />
						<p class="photo-description">{{ $albums[0]->description }}</p>
					</a>
				</div>
				<div class="photo-tile">
					<a href="fotos.html" class="photo-link" title="{{ $albums[1]->name }}">
						<img src="{{ $albums[1]->smallImage() }}" alt="{{ $albums[1]->name }}" />
						<p class="photo-description">{{ $albums[1]->description }}</p>
					</a>
				</div>
				<div class="photo-tile">
					<a href="fotos.html" class="photo-link" title="{{ $albums[2]->name }}">
						<img src="{{ $albums[2]->smallImage() }}" alt="{{ $albums[2]->name }}" />
						<p class="photo-description">{{ $albums[2]->description }}</p>
					</a>
				</div>
			</div>
			<div class="photo-grid-row">
				<div class="photo-tile first wide">
					<a href="fotos.html" class="photo-link" title="{{ $albums[3]->name }}">
						<img src="{{ $albums[3]->wideImage() }}" alt="{{ $albums[3]->name }}" />
						<p class="photo-description">{{ $albums[3]->description }}</p>
					</a>
				</div>
				<div class="photo-tile">
					<a href="fotos.html" class="photo-link" title="{{ $albums[4]->name }}">
						<img src="{{ $albums[4]->smallImage() }}" alt="{{ $albums[4]->name }}" />
						<p class="photo-description">{{ $albums[4]->description }}</p>
					</a>
				</div>
			</div>
			<div class="photo-grid-row">
				<div class="photo-tile first">
					<a href="fotos.html" class="photo-link" title="{{ $albums[5]->name }}">
						<img src="{{ $albums[5]->smallImage() }}" alt="{{ $albums[5]->name }}" />
						<p class="photo-description">{{ $albums[5]->description }}</p>
					</a>
				</div>
				<div class="photo-tile">
					<a href="fotos.html" class="photo-link" title="{{ $albums[6]->name }}">
						<img src="{{ $albums[6]->smallImage() }}" alt="{{ $albums[6]->name }}" />
						<p class="photo-description">{{ $albums[6]->description }}</p>
					</a>
				</div>
				<div class="photo-tile">
					<a href="fotos.html" class="photo-link" title="{{ $albums[7]->name }}">
						<img src="{{ $albums[7]->smallImage() }}" alt="{{ $albums[7]->name }}" />
						<p class="photo-description">{{ $albums[7]->description }}</p>
					</a>
				</div>
			</div>
			<div class="photo-grid-row">
				<div class="photo-tile first">
					<a href="fotos.html" class="photo-link" title="{{ $albums[8]->name }}">
						<img src="{{ $albums[8]->smallImage() }}" alt="{{ $albums[8]->name }}" />
						<p class="photo-description">{{ $albums[8]->description }}</p>
					</a>
				</div>
				<div class="photo-tile wide">
					<a href="fotos.html" class="photo-link" title="{{ $albums[9]->name }}">
						<img src="{{ $albums[9]->wideImage() }}" alt="{{ $albums[9]->name }}" />
						<p class="photo-description">{{ $albums[9]->description }}</p>
					</a>
				</div>
			</div>
		</div>

		{{ $albums->links() }}

	</div>
@stop