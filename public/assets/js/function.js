function showFile(input, show){
    let reader = new FileReader();
    reader.onload = function(e){
        $(show).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
}

function getUrl(add = ''){
    let url = window.location.href;
    var domain = url.split('/').slice(0, 3).join('/');
    return domain + '/' + add;
}

function getProvinces(item,code){
    let url = getUrl('api/vietnam/provinces');
    $.ajax({
        url : url,
        method: 'GET',
        success: function(reponse){
            let data = reponse.data;
            let check = '';
            let content = '<option value="0">--Chọn tỉnh thành--</option>';
            content += data.map(function(item){
                check = code==item.ma ? 'selected' : '';
                return `<option ${check} value="${item.ma}">${item.full_name}</option>`;
            }).join('');
            item.html(content);
        }
    })
}
function getDistricts(item,tinh,code){
    let url = getUrl('api/vietnam/districts/'+tinh);
    $.ajax({
        url : url,
        method: 'GET',
        success: function(reponse){
            let data = reponse.data;
            let check = '';
            let content = '<option value="0">--Chọn quận huyện--</option>';
            content += data.map(function(item){
                check = code==item.code ? 'selected' : '';
                return `<option ${check} value="${item.code}">${item.full_name}</option>`;
            }).join('');
            item.html(content);
        }
    })
}
function getWards(item,huyen,code){
    console.log(item,huyen,code);
    let url = getUrl('api/vietnam/wards/'+huyen);
    $.ajax({
        url : url,
        method: 'GET',
        success: function(response){
            let data = response.data;
            let check = '';
            let content = '<option value="0">--Chọn thị xã--</option>';
            content += data.map(function(item){
                check = code==item.code ? 'selected' : '';
                return `<option ${check} value="${item.code}">${item.full_name}</option>`;
            }).join('');
            item.html(content);
        },error: function (log){
            console.log(log);
        }
    })
}

function showDistricts(item,show,xa){
    let huyen = document.querySelector(show);
    document.querySelector(xa).innerHTML = '<option value="0" selected>--Chọn thị xã--</option>'
    let url = getUrl('api/vietnam/districts/'+item.value);
    $.ajax({
        url : url,
        method: 'GET',
        success: function(reponse){
            let data = reponse.data;
            let content = '<option value="0" selected>--Chọn quận huyện--</option>';
            content += data.map(function(item){
                return `<option value="${item.code}">${item.full_name}</option>`;
            }).join('');
            huyen.innerHTML = content;
        }
    })
}
function showWards(item,show){
    let xa = document.querySelector(show);
    let url = getUrl('api/vietnam/wards/'+item.value);
    $.ajax({
        url : url,
        method: 'GET',
        success: function(reponse){
            let data = reponse.data;
            let content = '<option value="0" selected>--Chọn thị xã--</option>';
            content += data.map(function(item){
                return `<option value="${item.code}">${item.full_name}</option>`;
            }).join('');
            xa.innerHTML = content;
        }
    })
}

function formatCurrency(input){
    let value = input.value.replace(/[^0-9]/g, '');
    value = parseFloat(value).toLocaleString('en-US');
    input.value = value;
}

function addCategoryUrl(event,id){
    event.preventDefault();
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    setPage(params);
    if (params.has('category')) {
        params.set('category', id);
    } else {
        params.append('category', id);
    }

    url.search = params.toString();
    window.location.href = url.toString();
}
function setPage(params){
    if (params.has('page')) {
        params.set('page', 1);
    } else {
        params.append('page', 1);
    }
}

function toggleImage(input,show){
    let image = $(show);
    let src = input.src;
    let a = image.find('.product__media--preview__items--link');
    a.attr('href',src);
    let img = a.find('.product__media--preview__items--img');
    img.attr('src',src);
    let aTow = image.find('.product__media--view__icon--link');
    aTow.attr('href',src);
}

function toggleCountUp(classInput){
    let value = +($(classInput).val());
    let max = $(classInput).attr('max');
    let reslove = value+1;
    if(reslove > max){
        reslove = value;
    }
    $(classInput).val(reslove);
}
function toggleCountDown(classInput){
    let value = +($(classInput).val());
    let min = $(classInput).attr('min');
    let reslove = value-1;
    if(reslove < min){
        reslove = 1;
    }
    $(classInput).val(reslove);

}
function generateRandomString(length) {
    let result = '';
    let characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    let charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

