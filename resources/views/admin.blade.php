@extends("layout")

@section("content")

	<div class="head">Категории</div>
	<form action="{{ route('category_add') }}" method="POST">
		@csrf
		<div class="part">
			<input type="text" name="category" placeholder="Категория">
			<button>Добавить</button>
		</div>
	</form>
	<form action="{{ route('category_delete') }}" method="POST">
		@csrf
		<div class="part">
			<select name="category_id" required>
				<option value="">Категории</option>
				@foreach($categories as $val)
					<option value="{{ $val->category_id }}">{{ $val->category }}</option>
				@endforeach
			</select>
			<button>Удалить</button>
		</div>
	</form>
	
	<div class="head">Добавить товар</div>

	<div class="head">Заказы</div>
	<div class="row">
		@foreach($orders as $val)
			<div class="col">
				<h3 class="text-left">Заказ {{ $val->order_id }}</h3>
				<p class="text-left">Количество товаров: <b>{{ $val->amount }}</b></p>
				<p class="text-left">Статус: <b>{{ $val->status }}</b></p>
				@if($val->status == "Отменённый")
					<p><b>Причина отмены</b></p>
					<p class="text-left">{{ $val->reason }}</p>
				@endif
				@if($val->status == "Новый")
					<form class="w100" action="{{ route('order_confirm') }}" method="POST">
						@csrf
						<button name="order_id" value="{{ $val->order_id }}">Подтвердить</button>
					</form>
					<h3 class="text-left">Отменить заказ</h3>
					<form class="w100" action="{{ route('order_reject') }}" method="POST">
						@csrf
						<textarea name="reason" placeholder="Причина отмены" required></textarea>
						<button name="order_id" value="{{ $val->order_id }}">Отменить</button>
					</form>
				@endif
			</div>
		@endforeach
	</div>

@endsection