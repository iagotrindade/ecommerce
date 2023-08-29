<x-adm_layout title="Pedidos" activeMenu="orders" userName="{{$authUser->name}}" userImage="{{$authUser->image}}">
    <x-orders_table>
        @slot('filterOption')
            @foreach ($orders as $order)
                <option value="{{$order['order_city']}}">{{$order['order_city']}}</option>
            @endforeach
        @endslot

        @foreach ($orders as $order)
            <tr id = "order-item" data-city="{{$order['order_city']}}">
                <th scope="row">
                    <a href="{{route('order', ['id' => $order['id']])}}" class="order-number">{{$order['code']}}</a>
                </th>

                <td>
                    {{$order['client_name']}}
                </td>

                <td>
                    {{$order['order_date']}}
                </td>

                <td>
                    R$  {{$order['total_amount']}}
                </td>

                <td id="payment-status">
                    <p class="{{$order['payment_color']}}">{{$order['payment_status']}}</p>
                </td>

                <td id="processing-status">
                    <p class="{{$order['processing_color']}}">{{$order['processing_status']}}</p></p>
                </td>
            </tr>
        @endforeach
    </x-orders_table>
</x-adm_layout>
