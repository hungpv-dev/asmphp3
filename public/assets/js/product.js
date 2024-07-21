$(document).on('change','.widget__form--check__input',function (){
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    setPage(params);

    if (params.has('seal')) {
        params.set('seal', $(this).val());
    } else {
        params.append('seal', $(this).val());
    }

    url.search = params.toString();
    window.location.href = url.toString();
});
$(document).on('submit','#form-keywords',function (e){
    e.preventDefault();
    let value = $(this).find("#keywords").val();
    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    setPage(params);
    if (params.has('keyword')) {
        params.set('keyword', value);
    } else {
        params.append('keyword', value);
    }
    url.search = params.toString();
    window.location.href = url.toString();
});
$(document).on('submit', '#form-price', function (e) {
    e.preventDefault();

    let min = $(this).find("#price_min").val().replace(/,/g, '');
    let max = $(this).find("#price_max").val().replace(/,/g, '');

    let url = new URL(window.location.href);
    let params = new URLSearchParams(url.search);
    setPage(params);

    if (!params.has('min')) {
        params.append('min', min);
    } else {
        params.set('min', min);
    }
    if (!params.has('max')) {
        params.append('max', max);
    } else {
        params.set('max', max);
    }

    url.search = params.toString();
    window.location.href = url.toString();
});

