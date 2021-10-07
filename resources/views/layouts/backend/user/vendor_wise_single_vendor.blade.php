<table id="vendor-wise-signle" class="table table-bordered table-striped">
  <thead>
    <tr role="row">
        <th class="sorting_asc">Brand Name</th>
        <th class="sorting_asc">logo</th>
        <th class="sorting">Address</th>
        <th class="sorting">Action</th>
    </tr>
  </thead>
  <tbody>
      @foreach($single_vendors as $single)
        <tr role="row" class="odd">
          <td class="sorting_1">{{optional($single)->brand_name}}</td>
          <td class="sorting_1">
            <img src="/images/{{optional($single)->logo}}" alt="#" width="50" height="60">
          </td>
          <td class="sorting_1">
              {{optional($single)->address}}
          </td>
          <td class="sorting_1">
              <button title="view product" onclick="showProduct({{$single->id}},'single_vendor_id')" class="btn btn-danger btn-sm">
                <i class="fab fa-pinterest-p"></i>
              </button>
          </td>
        </tr>
    @endforeach
  </tbody>
</table>