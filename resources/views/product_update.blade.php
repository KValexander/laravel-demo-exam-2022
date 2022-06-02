@extends("layout")

@section("content")

	<div class="head">Обновить товар</div>
	<form action="{{ route('product_update', ['id' => $product->product_id]) }}" method="POST">
		@csrf
		
	</form>

@endsection