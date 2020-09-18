@component('mail::message')
@php
$url = 'http://127.0.0.1:8000/order/approve/'.$data;
@endphp

# Order Approval Notification

The body of your message.

@component('mail::button', ['url' => $url])
Approve Order
@endcomponent

link = <a href="{{$url}}">click</a>

Thanks,<br>
{{ config('app.name') }}
@endcomponent
