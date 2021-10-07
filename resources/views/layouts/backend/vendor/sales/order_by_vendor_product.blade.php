
<table id="getProduct" class="table table-bordered table-striped">
    <thead>
        <tr role="row">
            <th style="width: 166px;">
                Product Name
            </th>

            <th style="width: 166px;">
                Purchase Price
            </th>
            <th style="width: 166px;">
                Sale Price
            </th>
            
            <th style="width: 166px;">
                Discount
            </th>
            <th style="width: 166px;">
                Admin Profit[TK]
            </th>
        </tr>
    </thead>
    <tbody>
            @foreach($details as $detail)
                <tr role="row" class="class="sorting_1"">
                    <td class="sorting_1">
                        {{optional($detail->get_vendor_product)->product_name}}
                    </td>
                    @foreach ($detail->get_vendor_product->get_product_attribute->unique('vendor_product_id') as $attr)
                    <td class="sorting_1">{{optional($attr)->pur_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->sale_price}} TK</td>
                    <td class="sorting_1">{{optional($attr)->discount}} %</td>
                        
                    @endforeach
                    <td class="sorting_1">{{optional($detail)->admin_profit}} TK</td>
                </tr>
            @endforeach
    </tbody>
</table>