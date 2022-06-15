@extends("layout")

@section("content")

	<div class="head">Корзина</div>
	<div class="row">
		@if(count($products))
			@foreach($products as $val)
				<div class="col">
					<img src="{{ asset('public/'. $val->path) }}" alt="">
					<div class="row">
						<a href="{{ route('product_page', ['id' => $val->product_id]) }}"><h3 id="name">{{ $val->name }}</h3></a>
						<p>{{ $val->price }}$</p>
					</div>
					<div class="row">
						<a class="small" href="{{ route('cart_remove', ['id' => $val->product_id]) }}">Убрать</a>
						<p class="small">{{ $val->amount }}</p>
						<a class="small" href="{{ route('cart_add', ['id' => $val->product_id]) }}">Добавить</a>
					</div>
				</div>
			@endforeach
		@else
			<h3>Корзина пуста</h3>
		@endif
	</div>
	<form action="{{ route('checkout') }}" method="POST">
		@csrf
		<input type="password" name="password" placeholder="Пароль" required>
		<button>Оформить заказ</button>
	</form>

	<div class="head">Заказы</div>
	<div class="row">
		@if(count($orders))
			@foreach($orders as $val)
				<div class="col">
					<h3 class="text-left">Заказ {{ $val->order_id }}</h3>
					@if($val->status == "Новый")
						<p class="text-left"><a class="small" href="{{ route('order_delete', ['id' => $val->order_id]) }}">Удалить заказ</a></p>
					@endif
					<p class="text-left">Статус: <b>{{ $val->status }}</b></p>
					<p class="text-left">Количество товаров: <b>{{ $val->amount }}</b></p>
					@if($val->status == "Отменённый")
						<h4>Причина отмены</h4>
						<p class="text-left">{{ $val->reason }}</p>
					@endif
				</div>
			@endforeach
		@else
			<h3>Заказы отсутствуют</h3>
		@endif
	</div>

@endsection