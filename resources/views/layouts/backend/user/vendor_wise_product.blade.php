<table id="vendor-wise-product" class="table table-bordered table-striped">
  <thead>
    <tr role="row">
        <th class="sorting_asc">Brand Name</th>
        <th class="sorting_asc">Product Name</th>
        <th class="sorting">Sale Price</th>
        <th class="sorting">Admin Percent</th>
    </tr>
  </thead>
  <tbody>
     @foreach($vendor_product as $venPro)
     @if($venPro->vendor_id != null && $venPro->single_vendor_id == null)
        <tr role="row" class="odd">
          <td class="sorting_1">{{optional($venPro->get_vendor)->brand_name}}</td>
          <td class="sorting_1">
            <p class="badge badge-success">{{optional($venPro)->product_name}}</p>
          </td>
          <td>{{optional($venPro)->sale_price}}</td>
          <td>{{optional($venPro)->admin_percent ?? 00}} %</td>
        </tr>
    @endif
    @if($venPro->vendor_id != null && $venPro->single_vendor_id != null)
        <tr role="row" class="odd">
          <td class="sorting_1">{{optional($venPro->get_single_vendor)->brand_name}}</td>
          <td class="sorting_1">
            <p class="badge badge-success">{{optional($venPro)->product_name}}</p>
          </td>
          <td>{{optional($venPro)->sale_price}}</td>
          <td>{{optional($venPro)->admin_percent ?? 00}} %</td>
        </tr>
    @endif
    @endforeach
  </tbody>
</table>