@extends("layout")

@section("content")

	<div class="head">Обновить товар</div>
	<form enctype="multipart/form-data" action="{{ route('product_update', ['id' => $product->product_id]) }}" method="POST">
		@csrf

		<input type="text" name="name" value="{{ $product->name }}" placeholder="Название" required>

		<input type="number" name="price" value="{{ $product->price }}" placeholder="Цена" required>
		
		<input type="text" name="country" value="{{ $product->country }}" placeholder="Страна" required>
		
		<input type="number" name="year" value="{{ $product->year }}" placeholder="Год выпуска" pattern="[0-9]{4}" required>
		
		<input type="text" name="model" value="{{ $product->model }}" placeholder="Модель" required>

		<select name="category" required>
			<option value="">Категория</option>
			@foreach($categories as $val)
				@if($val->category == $product->category)
					<option value="{{ $val->category }}" selected>{{ $val->category }}</option>
				@else
					<option value="{{ $val->category }}">{{ $val->category }}</option>
				@endif
			@endforeach
		</select>

		<input type="text" value="{{ $product->count }}" name="count" placeholder="Количество">

		<p class="text-left">Фотография товара</p>
		<input type="file" name="image">

		<button>Обновить</button>
		
	</form>

@endsection