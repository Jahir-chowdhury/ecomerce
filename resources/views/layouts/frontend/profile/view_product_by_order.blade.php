
<table id="getProduct">
    <thead>
        <tr role="row">
            <th style="width: 166px;">
                Name
            </th>
            <th style="width: 166px;">
                Image
            </th>
            <th style="width: 166px;">
                Price
            </th>
            <th style="width: 166px;">
                Discount
            </th>
        </tr>
    </thead>
    <tbody>
            @foreach($details as $detail)
                @if($detail->get_product != null)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td>
                        {{$detail->get_product->product_name}}
                    </td>
                    <td>
                        @foreach($detail->get_product->get_product_avatars as $avtr)
                        <img style="max-width: 80px !important;
                            height: 50px !important;" src="/images/{{$avtr->front}}" width="500" height="600">
                        @endforeach
                    </td>
                    @foreach ($detail->get_product->get_attribute->unique('product_id') as $attr)
                        <td>{{$attr->sale_price}} TK</td>
                        <td>{{$attr->discount}} %</td>
                    @endforeach
                </tr>
                @endif
                @if($detail->get_vendor_product != null)
                <tr style="border-bottom: 1px solid #ddd;">
                    <td>
                        {{$detail->get_vendor_product->product_name}}
                    </td>
                    <td>
                        @foreach($detail->get_vendor_product->get_vendor_product_avatar as $avtr)
                        <img style="max-width: 80px !important;
                            height: 50px !important;" src="/images/{{$avtr->front}}" width="500" height="600">
                        @endforeach
                    </td>
                    @foreach ($detail->get_vendor_product->get_product_attribute->unique('vendor_product_id') as $attr)
                        <td>{{$attr->sale_price}} TK</td>
                        <td>{{$attr->discount}} %</td>
                    @endforeach
                </tr>
                @endif
            @endforeach
    </tbody>
</table>