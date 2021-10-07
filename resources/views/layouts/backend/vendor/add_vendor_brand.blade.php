<div class="card-body row col-12" id="addBrandForm" style="display: none;">
    <form method="POST" id="singleVendor" enctype="multipart/form-data">
        @csrf
        <p style="display: none;background-color: #b2b979;
        width: 33%;padding: 4px 0px 6px 10px;color:#fff" id="info">Are You Single Vendor ???
          <span style="cursor: pointer;margin-right:5px;margin-left: 10px;" class="badge badge-success" onclick="active()">Yes</span>
          <span style="cursor: pointer;" class="badge badge-warning" onclick="inactive()">No</span>
        </p>
      <div class="row col-12">
            <div class="form-group col-6">
                <label class="mr-sm-2" for="inlineFormCustomSelect"
                >Select Vendor</label
                >
                <select class="form-control" onclick="getVendorId()" name="vendor_id" id="vendor_id">
                    <option value="" selected="selected" hidden>select</option>
                    @foreach ($vendors as $ven)
                    <option value="{{ $ven->id }}">
                        {{ $ven->brand_name }}
                    </option>
                    
                    @endforeach
                    <input type="text" id="vendors" name="vendors" value="{{$vendors}}" hidden>

                </select>
                
            </div>

          <div class="form-group col-6">
              <label class="mr-sm-2" for="inlineFormCustomSelect"
                  >Brand Name</label
                  >
              <input
                  id="brand_name"
                  name="brand_name"
                  type="text"
                  class="form-control"
                  placeholder="Enter brand name" readonly
              />
          </div>
          <div style="display: none;" class="form-group col-3" id="logoDiv1">
            <div style="background-color:#ddd;height: 73%;
            width: 75%;
            margin-top: 37px;">

            </div>
          </div>
          <div style="display: block;" class="form-group col-3" id="logoDiv">
            <label for="image" class="col-form-label">logo</label>
            <div style="height: 100px;
                border: dashed 1.5px blue;
                background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                width: 60% !important;
                cursor: pointer;">
              <input style="opacity: 0;
              height: 100px;
              cursor: pointer;
              padding: 0px;" type="file" class="form-control" id="logo" name="logo" disabled>
              <img src="#" id="logo-img" style="height: 100px;
              width: 100% !important;
              cursor: pointer;
              margin-top: -134px;"/>
            </div>
          </div>
          <div class="form-group col-3" style="margin-left: -45px;
          margin-right: 45px;">
            <label for="image" class="col-form-label">Banar</label>
            <div style="height: 100px;
                border: dashed 1.5px blue;
                background-image: repeating-linear-gradient(45deg, black, transparent 100px);
                width: 100% !important;
                cursor: pointer;">
              <input style="opacity: 0;
              height: 100px;
              cursor: pointer;
              padding: 0px;" id="banar" type="file" class="form-control" name="banar" disabled>
              <img src="#" id="banar-img" style="height: 100px;
              width: 100% !important;
              cursor: pointer;
              margin-top: -134px;"/>
            </div>
          </div>
          <div class="form-group col-6">
            <label class="mr-sm-2" for="inlineFormCustomSelect"
                >Address</label
                >
            <textarea
                style="min-height: 106px;"
                name="address"
                type="text"
                class="form-control"
                placeholder="Enter address"
            ></textarea>
        </div>
      </div>
        <button style="width: 100%" class="btn btn-primary" type="submit" id="submit-all">Submit</button>
    </form>
</div>
