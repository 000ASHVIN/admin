<table class="table">
    <input type="hidden" name="" id="product-current-page" value="{{$currentPage}}">
    <thead>
        <tr>
            <td></td>
            <td>Product Name</td>
            <td>Product Price</td>
            <td>Product Image</td>
            <td>Product Stock</td>
            <td>Product Live</td>
            <td>Product Location</td>
        </tr>
    </thead>
@foreach($products as $product)

    <tbody>
        <tr>
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>
                <span>{{$product->product_name}}</span>
            </td>
            <td>
                <span>{{$product->product_price}}</span>
            </td>
            <td>
                <span><img src="/storage/{{$product->product_image}}" alt=""></span>
            </td>
            <td>
                <span>{{$product->product_stock}}</span>
            </td>
            <td>
                <span>{{$product->product_live}}</span>
            </td>
            <td>
                <span>{{$product->product_location}}</span>
            </td>
            <td>
                <a href="/products/{{$product->id}}/edit" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="/products/{{$product->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>  

@endforeach
</table>