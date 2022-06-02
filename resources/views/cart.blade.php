@extends("layout")

@section("content")

	<div class="head">Корзина</div>
	<div class="row">
		@if(count($products))
		@else
			<h3>Корзина пуста</h3>
		@endif
	</div>

	<form action="{{ route('checkout') }}" method="POST">
		@csrf
		<input type="password" placeholder="Пароль">
		<button>Оформить заказ</button>
	</form>

	<div class="head">Заказы</div>
	<div class="row">
		@if(count($orders))
			@foreach($orders as $val)
				<h3>Заказ {{ $val->order_id }}</h3>
				<p>Количество товаров: <b>{{ $val->count }}</b></p>
				<p>Статус: <b>{{ $val->status }}</b></p>
			@endforeach
		@else
			<h3>Заказы отсутствуют</h3>
		@endif
	</div>

@endsection