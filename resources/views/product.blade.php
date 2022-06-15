@extends("layout")

@section("content")

	<div class="head">Товар</div>

	<div class="row">
		<div class="wrap">
			<img src="{{ asset('public/'. $product->path) }}" alt="">
		</div>
		<div class="wrap">
			<h3>{{ $product->name }}</h3>
			<p>Цена: <b>{{ $product->price }}$</b></p>
			<p>Страна: <b>{{ $product->country }}</b></p>
			<p>Год выпуска: <b>{{ $product->year }}</b></p>
			<p>Модель: <b>{{ $product->model }}</b></p>

			@if($role == "admin")
				<div class="row">
					<p><a class="small" href="{{ route('product_update_page', ['id' => $product->product_id]) }}">Редактировать</a></p>
					<p><a class="small" href="{{ route('product_delete', ['id' => $product->product_id]) }}">Удалить</a></p>
				</div>
			@endif

			@if($role != "guest" )
				<p class="text-right"><a class="small" href="{{ route('cart_add', ['id' => $product->product_id]) }}">В корзину</a></p>
			@endif
		</div>
	</div>

@endsection