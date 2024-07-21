@extends('layouts.admin')
@section('title')
    {{$title}}
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="main-content">
            <!-- Page Title Start -->
            <div class="row">
                <div class="colxl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-title-wrapper">
                        <div class="page-title-box ad-title-box-use">
                            <h4 class="page-title">Phí vận chuyển</h4>
                        </div>
                        <div class="ad-breadcrumb">
                            <ul>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mb-3">
                <form id="form-feeship" class="bg-white border-dark">
                    <select name="" onchange="getDistricts(this,$('#districts'))" id="provinces">
                        <option value="0">--Chọn tỉnh thành--</option>
                    </select>
                    <select name="" onchange="getWards(this,$('#wards'))" id="districts">
                        <option value="0">--Chọn quận huyện--</option>
                    </select>
                    <select name="" id="wards">
                        <option value="0">--Chọn thị xã--</option>
                    </select>
                    <label for="" class="m-0">
                        <input type="text" name="" id="price" placeholder="Phí vận chuyển">
                    </label>
                    <button class="btn btn-primary">Xác nhận</button>
                </form>
            </div>
            <!-- Table Start -->
            <div class="row">
                <!-- Styled Table Card-->
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card table-card">
                        <div class="card-header pb-0">
                            <h4>Danh sách phí vận chuyển</h4>
                        </div>
                        <div class="card-body">
                            <div class="chart-holder">
                                <div class="table-responsive">
                                    <table class="table table-styled mb-0">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tỉnh thành</th>
                                            <th>Quận huyện</th>
                                            <th>Thị xã</th>
                                            <th>Phí vận chuyển</th>
                                        </tr>
                                        </thead>
                                        <tbody id="app">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ad-footer-btm">
                    <p>Copyright 2022 © SplashDash All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function loadData(pro = false,dis = false){
            let url = getUrl('api/feeships');
            if(pro){
                let province = $('#provinces option:selected').text();
                url += '?province='+province;
            }
            if(dis){
                let district = $('#districts option:selected').text();
                url += '&district='+district;
            }
            let ward = $('#wards').val();
            $.ajax({
                url : url,
                method: 'GET',
                success: function (response){
                    if(response.code == 200){
                        let data = response.data;
                        let content = data.map(item => {
                           return `
                             <tr>
                                <td>${item.id}</td>
                                <td>${item.province}</td>
                                <td>${item.district}</td>
                                <td>${item.ward}</td>
                                <td>${item.price}</td>
                            </tr>
                           ` ;
                        }).join('');
                        $('#app').html(content);
                    }
                }
            })
        }
        loadData();
        function getProvinces(select){
            let url = getUrl('api/vietnam/provinces');
            $.ajax({
                url : url,
                method: 'GET',
                success: function(reponse){
                    let data = reponse.data;
                    let content = '<option value="0">--Chọn tỉnh thành--</option>';
                    content += data.map(function(item){
                        return `<option value="${item.ma}">${item.full_name}</option>`;
                    }).join('');
                    select.html(content);
                }
            })
        }
        function getDistricts(input,huyen){
            let code = input.value;
            let url = getUrl('api/vietnam/districts/'+code);
            $.ajax({
                url : url,
                method: 'GET',
                success: function(response){
                    let data = response.data;
                    let content = '<option value="0">--Chọn quận huyện--</option>';
                    content += data.map(function(item){
                        return `<option value="${item.code}">${item.full_name}</option>`;
                    }).join('');
                    huyen.html(content);
                    $("#wards").html(`<option>--Chọn thị xã--</option>`);
                    loadData(true);
                }
            })
        }
        function getWards(input,xa){
            let code = input.value;
            let url = getUrl('api/vietnam/wards/'+code);
            $.ajax({
                url : url,
                method: 'GET',
                success: function(response){
                    let data = response.data;
                    let content = '<option value="0">--Chọn thị xã--</option>';
                    content += data.map(function(item){
                        return `<option value="${item.code}">${item.full_name}</option>`;
                    }).join('');
                    xa.html(content);
                    loadData(true,true);
                }
            })
        }
        $(document).on('submit','#form-feeship',function(e){
           e.preventDefault();
            let province = $('#provinces option:selected').text();
            let district = $('#districts option:selected').text();
            let ward = $('#wards option:selected').text();
            let price = $('#price').val().trim();
            if(province == '--Chọn tỉnh thành--'){
                swal('Vui lòng chọn tỉnh thành',{
                    icon: 'warning'
                })
            }else if(district == '--Chọn quận huyện--'){
                swal('Vui lòng chọn quận huyện',{
                    icon: 'warning'
                })
            }else if(ward == '--Chọn thị xã--'){
                swal('Vui lòng chọn thị xã',{
                    icon: 'warning'
                })
            }else if(price == ''){
                swal('Vui lòng nhập phí vận chuyển',{
                    icon: 'warning'
                })
            }else if(isNaN(price)){
                swal('Phí ship phải là số ',{
                    icon: 'warning'
                })
            }else if(price < 0 || price.length > 6) {
                swal('Phí ship không hợp lệ',{
                    icon: 'warning'
                })
            }else{
                $.ajax({
                    url: getUrl('api/feeships'),
                    method: 'POST',
                    data: {province,district,ward,price},
                    success: function(response){
                        if(response.code == 201){
                            swal(response.message,{
                                icon: 'warning'
                            })
                            let data = response.data;
                            let content = `
                                 <tr>
                                    <td>${data.id}</td>
                                    <td>${data.province}</td>
                                    <td>${data.district}</td>
                                    <td>${data.ward}</td>
                                    <td>${data.price}</td>
                                </tr>
                            ` ;
                            loadData(true);
                            document.getElementById('form-feeship').reset();
                        }
                    },error: function(log){
                        console.log(log);
                    }
                })
            }
        });
        $(document).ready(function(){
            getProvinces($("#provinces"));
        });
    </script>
@endsection
