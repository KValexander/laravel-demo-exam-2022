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
	<form enctype="multipart/form-data" action="{{ route('product_add') }}" method="POST">
		@csrf

		<input type="text" name="name" placeholder="Название" required>

		<input type="number" name="price" placeholder="Цена" required>
		
		<input type="text" name="country" placeholder="Страна" required>
		
		<input type="number" name="year" placeholder="Год выпуска" pattern="[0-9]{4}" required>
		
		<input type="text" name="model" placeholder="Модель" required>

		<select name="category" required>
			<option value="">Категория</option>
			@foreach($categories as $val)
				<option value="{{ $val->category }}">{{ $val->category }}</option>
			@endforeach
		</select>

		<input type="text" name="count" placeholder="Количество">

		<p class="text-left">Фотография товара</p>
		<input type="file" name="image" required>

		<button>Добавить</button>

	</form>

	<div class="head">Заказы</div>

	<p>
		<span onclick="filtration('orders', 'all')">Все</span> |
		<span onclick="filtration('orders', 'status', 'Новый')">Новые</span> |
		<span onclick="filtration('orders', 'status', 'Подтверждённый')">Подтверждённые</span> |
		<span onclick="filtration('orders', 'status', 'Отменённый')">Отменённые</span>
	</p>

	<div class="row" id="orders">
		@if(count($orders))
			@foreach($orders as $val)
				<div class="col">
					<h3 class="text-left">Заказ {{ $val->order_id }}</h3>
					<p class="text-left">ФИО: <b>{{ $val->name }} {{ $val->surname }} {{ $val->patronymic }}</b></p>
					<p class="text-left">Количество товаров: <b>{{ $val->amount }}</b></p>
					<p class="text-left">Статус: <b id="status">{{ $val->status }}</b></p>
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
					<p class="small text-right">{{ $val->created_at }}</p>
				</div>
			@endforeach
		@else
			<h3>Заказы отсутствуют</h3>
		@endif
	</div>

@endsection