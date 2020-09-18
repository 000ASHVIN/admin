<table class="table">
    <thead>
    <tr>
        <td></td>
        <td>Order</td>
        <td>User Id</td>
        <td>User</td>
        <td>Date</td>
        <td>Status</td>
        <td>Approve/Discard</td>
        <td>Billing</td>
        <td></td>
    </tr>
</thead>
@foreach($orders as $order)
    <tbody>
        <tr>
            <td>
                <label class="au-checkbox">
                    <input type="checkbox">
                    <span class="au-checkmark"></span>
                </label>
            </td>
            <td>
                <span>#{{$order->id}}</span>
            </td>
            <td>{{$order->user->id}}</td>
            <td>{{$order->user->username}}</td>
            <td>
                <span>{{$order->created_at}}</span>
            </td>
            <td>
                @if($order->status == 'approved')
                    <span class="text-success">approved</span>
                @elseif($order->status == 'pending')
                    <span class="text-danger">pending</span>
                @endif
            </td>
            <td>
                @if($order->status == 'approved')
                <a href="/order/discard/{{$order->id}}" class='btn btn-danger'>Discard</a>
                @elseif($order->status == 'pending')
                <a href="/order/approve/{{$order->id}}" class='btn btn-primary'>Approve</a>
                @endif
            </td>
            <td>
                <span>paypal</span>
            </td>
            <td><a href="/order/{{$order->id}}" class='btn btn-primary'>Details</a></td>
        </tr>
    </tbody>
@endforeach
</table>