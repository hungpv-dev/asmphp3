@extends('account.layout-account')
@section('title')
    {{$title}}
@endsection
@section('main')
        <form method="POST" action="{{route('account.address')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">
                <h4 class="card-title mb-0">Chỉnh sửa thông tin</h4>
                <div class="card-options"><a class="card-options-collapse" href="javascript:;" data-bs-toggle="card-collapse" data-bs-original-title="" title=""><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="javascript:;" data-bs-toggle="card-remove" data-bs-original-title="" title=""><i class="fe fe-x"></i></a></div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <input type="file" accept="image/*" name="image" onchange="showFile(this,'.showImageProfile')" class="d-none" id="file-profile">
                        <div class="d-flex justify-content-center">
                            <label for="file-profile" class="cursor-pointer">
                                <img style="width: 100px; height: 100px; border-radius: 50%; object-fit: cover;" class="showImageProfile" src="{{optional($user->image)->url}}" alt="">
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Họ</label>
                            <input name="first_name" value="{{$profile->first_name}}" class="form-control fs-3" type="text" placeholder="Họ" data-bs-original-title="" title="">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Tên</label>
                            <input name="last_name" value="{{$profile->last_name}}" class="form-control fs-3" type="text" placeholder="Tên" data-bs-original-title="" title="">
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input name="tel" value="{{$profile->tel}}" class="form-control fs-3" type="text" placeholder="Số điện thoại" data-bs-original-title="" title="">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input name="address" value="{{$profile->address}}" class="form-control fs-3" type="text" placeholder="Địa chỉ chi tiết" data-bs-original-title="" title="">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 form-select-btn">
                            <label class="form-label">Thành Phố</label>
                            <select name="province" id="tinh" onchange="showDistricts(this,'#huyen','#xa')" class="form-control btn-square form-btn fs-3">
                                <option value="0">--Chọn tỉnh thành--</option>
                            </select>
                            <span class="sel_arrow">
                                        <i class="fa fa-angle-down "></i>
                                    </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 form-select-btn">
                            <label class="form-label">Quận/Huyện</label>
                            <select name="district" id="huyen" onchange="showWards(this,'#xa')" class="form-control btn-square form-btn fs-3">
                                <option value="0">--Chọn thị trấn--</option>
                            </select>
                            <span class="sel_arrow">
                                        <i class="fa fa-angle-down "></i>
                                    </span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="mb-3 form-select-btn">
                            <label class="form-label">Thị/Xã</label>
                            <select name="ward" id="xa" class="form-control btn-square form-btn fs-3">
                                <option value="0">--Chọn thị xã --</option>
                            </select>
                            <span class="sel_arrow">
                                        <i class="fa fa-angle-down "></i>
                                    </span>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary squer-btn fs-3" type="submit" data-bs-original-title="" title="">Cập nhật thông tin</button>
            </div>
        </form>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            getProvinces($("#tinh"),{{$profile->tinh}});
            getDistricts($("#huyen"),{{$profile->tinh}},{{$profile->huyen}});
            getWards($("#xa"),{{$profile->huyen}},{{$profile->xa}});
        });
    </script>
@endsection
