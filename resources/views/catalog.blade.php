@extends("layout")

@section("content")

	<div class="head">Наши товары</div>
	
	<div class="row">
		<p>
			<span onclick="sorting('catalog', 'year')">Год производства</span> |
			<span onclick="sorting('catalog', 'name')">Название</span> |
			<span onclick="sorting('catalog', 'price')">Цена</span>
		</p>
		<p>
			<select onchange="filtration('catalog', 'category', this.value)">
				<option value="all">Категории</option>
				@foreach($categories as $val)
					<option value="{{ $val->category }}">{{ $val->category }}</option>
				@endforeach
			</select>
		</p>
	</div>

	<div class="row" id="catalog">
		@foreach($products as $val)
			<div class="col">
				<img src="{{ asset('public/'. $val->path) }}" alt="">
				<div class="row">
					<a href="{{ route('product_page', ['id' => $val->product_id]) }}"><h3 id="name">{{ $val->name }}</h3></a>
					<p id="price">{{ $val->price }}$</p>
				</div>
				<p class="none" id="year">{{ $val->year }}</p>
				<p class="none" id="category">{{ $val->category }}</p>

				@if($role == "admin")
					<div class="row">
					<p><a class="small" href="{{ route('product_update_page', ['id' => $val->product_id]) }}">Редактировать</a></p>
					<p><a class="small" onclick="return confirm('Вы уверены?')" href="{{ route('product_delete', ['id' => $val->product_id]) }}">Удалить</a></p>
					</div>
				@endif

				@if($role != "guest" )
					<p class="text-right"><a class="small" href="{{ route('cart_add', ['id' => $val->product_id]) }}">В корзину</a></p>
				@endif
			</div>
		@endforeach
	</div>

@endsection