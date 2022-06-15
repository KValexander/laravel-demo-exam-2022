@extends("layout")

@section("content")

	<div class="head">Категории</div>
	<form action="{{ route('category_add') }}" method="POST">
		@csrf
		<div class="part">
			<input type="text" name="category" placeholder="Категория" required>
			<button>Добавить</button>
		</div>
	</form>

	<form action="{{ route('category_delete') }}" method="POST">
		@csrf
		<div class="part">
			<select name="category_id" required>
				<option value="" selected disabled>Категории</option>
				@foreach($categories as $val)
					<option value="{{ $val->category_id }}">{{ $val->category }}</option>
				@endforeach
			</select>
			<button>Удалить</button>
		</div>
	</form>

	<div class="head">Добавление товара</div>

	<div class="head">Заказы</div>
	<p>
		<span onclick="filtration('orders', 'status', 'all')">Все</span> |
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
					<p class="text-left">Статус: <b id="status">{{ $val->status }}</b></p>
					<p class="text-left">Количество товаров: <b>{{ $val->amount }}</b></p>
					@if($val->status == "Отменённый")
						<h4>Причина отмены</h4>
						<p class="text-left">{{ $val->reason }}</p>
					@endif
					@if($val->status == "Новый")
						<form class="w100" action="{{ route('order_confirm', ['id' => $val->order_id]) }}" method="POST">
							@csrf
							<button>Подтвердить</button>
						</form>
						<h4 class="text-left">Отменить заказ</h4>
						<form class="w100" action="{{ route('order_reject', ['id' => $val->order_id]) }}" method="POST">
							@csrf
							<textarea name="reason" required placeholder="Причина отмены"></textarea>
							<button>Отменить</button>
						</form>
					@endif
					<!-- Не совсем та, но всё же временная метка, хахаха, я не хочу писать select -->
					<p class="text-right small">{{ $val->created_at }}</p>
				</div>
			@endforeach
		@else
			<h3>Заказы отсутсвуют</h3>
		@endif
	</div>

@endsection