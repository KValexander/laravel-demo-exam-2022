@extends("layout")

@section("content")

	<div class="head">Товар</div>

	<div class="sides row">
		<div class="col">
			<img src="{{ asset('public/'. $product->path) }}" alt="">
		</div>
		<div class="col text-left">
			<h2>{{ $product->name }}</h2>
			<p>Страна производитель: <b>{{ $product->country }}</b></p>
			<p>Год выпуска: <b>{{ $product->year }}</b></p>
			<p>Модель: <b>{{ $product->model }}</b></p>
			<hr>
			<div class="row">
				<p>Цена:</p>
				<b>{{ $product->price }}$</b>
			</div>

			@if($role == "admin")
				<div class="row">
					<p>
						<a class="small" href="{{ route('product_update_page', ['id' => $product->product_id]) }}">Редактировать</a>
					</p>
					<p>
						<a class="small" href="{{ route('product_delete', ['id' => $product->product_id]) }}">Удалить</a>
					</p>
				</div>
			@endif
			@if($role != "guest")
				<p class="text-right"><a class="small" href="{{ route('cart_add', ['id' => $product->product_id]) }}">В корзину</a></p>
			@endif
		</div>
	</div>

@endsection