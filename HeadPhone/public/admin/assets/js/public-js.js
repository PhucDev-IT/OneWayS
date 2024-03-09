//Format tiền tệ

function formatCurrency(number) {
    return new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(number);
}


//---------------- PHÂN TRANG----------------------------

function customPaginate(response) {
    $('.pagination').empty();

    if (response.products.data.length === 0) return;

    var paginationHtml = `<nav class="pagination_contain" aria-label="Page navigation example" style="margin-top: 10px;">
                            <ul class="pagination">`;

    $.each(response.products.links, function(key, link) {
        paginationHtml += `<li class="page-item ${link.active ? 'active' : ''}">
                                <a class="page-link" href="javascript:void(0);" onclick="getDataByPage('${link.url}',${link.active});">${link.label}</a>
                            </li>`;
    });

    paginationHtml += `</ul>
                      </nav>`;

    $('.pagination').append(paginationHtml);
}
