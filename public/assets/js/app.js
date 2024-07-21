getCategories();


function getCategories(page='null'){
    fetch(getUrl('api/categories?page='+page))
        .then(response => response.json())
        .then(function(response){
           let data = response.data;
           let select = document.querySelector("#header-categories");
           let content = '<option selected value="0">Tất cả danh mục</option>';
           content += data.map(item => {
               return `
                   <option value="${item.ma}">${item.ten}</option>
               `
           }).join('');
           select.innerHTML = content;
        });
}

$(document).on('click','.clost-remember',function(){
    $(this).closest('.box-remember').remove();
})
$(document).on('click','.add-remember',function(){
    let that = $(this);
    $.ajax({
        url: getUrl('remember'),
        method: 'get',
        success: function (data){
            console.log(data);
            that.closest('.box-remember').remove();
        },
        error: function(log){
            console.log(log);
        }
    })
})

