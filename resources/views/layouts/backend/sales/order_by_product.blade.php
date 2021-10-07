
<table id="getProduct" class="table table-bordered table-striped">
    <thead>
        <tr role="row">
            <th style="width: 166px;">
                Product Name
            </th>

            <th style="width: 166px;">
                Purchase/Price
            </th>
            <th style="width: 166px;">
                Sale/Price
            </th>
            <th style="width: 166px;">
                Discount
            </th>
        </tr>
    </thead>
    <tbody>
            @foreach($details as $detail)
                <tr role="row" class="class="sorting_1"">
                    <td class="sorting_1">
                        {{optional($detail->get_product)->product_name}}
                    </td>
                    @if($detail->get_product)
                    @foreach ($detail->get_product->get_attribute->unique('product_id') as $attr)
                    <td class="sorting_1">{{optional($attr)->pur_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->sale_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->discount}} %</td>
                        
                    @endforeach
                    @endif
                </tr>
            @endforeach
    </tbody>
</table>