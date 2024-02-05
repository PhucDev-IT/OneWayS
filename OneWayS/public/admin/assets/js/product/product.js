



//---------------SỬ LÝ ẢNH --------------------------------



//Xóa ảnh đã chọn
function removeImage(value) {
    var id = $(value).data('id');
    var indexToRemove = dataImages.findIndex(image => image.id === id);
    if (indexToRemove >= 0) {
        $(`#preview_${id}`).remove();
        dataImages.splice(indexToRemove, 1);
    }
    appendImagesToForm(dataImages);
}



function appendImagesToForm(images) {
    $("#currentImagesPrivew").val(JSON.stringify(images));
}



//Show image đã chọn
function renderImage(path) {
    let html = `
               <div style="border: 2px solid black;margin-left:8px";">
               <img src="${URL.createObjectURL(path)}"  alt="" width="100" 
               height="100" ">
               </div>
                `;
    $("#preview").append(html);
}

//Thêm phân loại sản phẩm
$(document).on("click", "#btn-add-classify", function () {
    // Lấy giá trị từ các trường input
    var colorValue = document.getElementById('input-color').value;
    var quantityValue = document.getElementById('input-quantity').value;

    // Kiểm tra xem giá trị có hay không
    if (colorValue.trim() !== '' && quantityValue.trim() !== '') {
        let classify = {
            id: Date.now(),
            color: colorValue,
            quantity: quantityValue
        };
        classifies = [...classifies, classify];
        renderClassify(classify);
        appendClassifyToForm();

        document.getElementById('input-color').value = '';
        document.getElementById('input-quantity').value = "";

    } else {
        alert('Vui lòng nhập đầy đủ thông tin');
    }

});





function renderClassifies(classifies) {
    for (let classify of classifies) {
        renderClassify(classify);
    }
    appendClassifyToForm();
}


function renderClassify(classify) {
    let html = `
    <div class="row" id="product-classify${classify.id}">
        <div class="col">
            <div class="form-group">
             <input type="text" class="form-control "  value="${classify.color}" readonly>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
            <input type="text" class="form-control " value="${classify.quantity}" readonly>
            </div>
        </div>

         <div class="col ">
            <span id="remove-classify" data-id="${classify.id}"> <i class="fa-solid fa-trash-can" style="color: #ff0000; margin-top:10px;"></i></span>
        </div>
    </div>

    `;

    $("#classify-body").append(html);
}


$(document).on("click", "#remove-classify", function () {
    let id = $(this).data("id");
    removeClassify(classifies, id);

});


function removeClassify(classifies, id) {
    var indexToRemove = classifies.findIndex(classify => classify.id === id);
    if (indexToRemove >= 0) {
        $(`#product-classify${classifies[indexToRemove].id}`).remove();
        classifies.splice(indexToRemove, 1);
        appendClassifyToForm();
    }
}

function appendClassifyToForm() {
    $("#inputClassifies").val(JSON.stringify(classifies));
}



function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $("#show-image").attr("src", e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    }
}

$("#image-input").change(function () {
    readURL(this);
});
