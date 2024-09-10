<x-layout>
    <div class="page-heading header-text">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                <h3>Orders</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="section trending">
        <div class="container">
            <table class="table caption-top">
                <caption>List of games</caption>
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Game name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total price</th>
                        <th scope="col">Game image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order -> id}}</td>
                        <td>{{$order ->game-> name}}</td>
                        <td>{{$order -> quantity}}</td>
                        <td>{{$order -> total_price}}</td>
                        <td><img
                            src="{{asset('/storage/'.$order ->game ->image)}}"
                            class="rounded mx-auto d-block"
                            style="width: 300px; height: 300px;"
                            alt=""
                            />
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
                {{$orders -> links('pagination::bootstrap-5')}}
        </div>
    </div>
</x-layout>