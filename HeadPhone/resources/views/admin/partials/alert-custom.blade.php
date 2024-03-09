<div class="container-alert">

    <div class="alert-custom alert-success" id="success">
        <i class="mdi mdi-close"></i>
        <strong>Success!</strong> 
        <span id="mess-success">Yêu cầu xử lý đã được hoàn thành.</span>
    </div>
    <div class="alert-custom alert-info" id="infor">
        <i class="mdi mdi-close"></i>
        <strong>Info!</strong> <span class="mess-infor">Có thông tin mới!</span>
    </div>
    <div class="alert-custom alert-warning" id="warning">
        <i class="mdi mdi-close"></i>
        <strong>Warning!</strong> <span class="mess-warning">Cảnh báo Cảnh báo</span>
    </div>
    <div class="alert-custom alert-danger" id="danger">
        <i class="mdi mdi-close"></i>
        <strong>Danger!</strong> <span class="mess-danger">Đã xảy ra lỗi trong quá trình xử lý, thử lại sau!</span>
    </div>
</div>

<style>
    .alert-custom {
        display: none;
        position: relative;
        padding: 1rem;
        /* Có thể điều chỉnh độ dày của padding theo ý muốn */
        margin-bottom: 1rem;
        /* Có thể điều chỉnh độ cao giữa các hộp thông báo */
        border: 1px solid transparent;
        /* Có thể điều chỉnh đường viền theo ý muốn */

    }

    .alert-custom .mdi-close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 1rem;
        /* Có thể điều chỉnh độ dày của padding theo ý muốn */
    }
</style>
<script>
    function showAlert(type, mess) {
        var alertType = document.querySelector('#' + type);
        var data = document.querySelector('#mess-'+type);
        alertType.style.display = 'block';
        data.innerText  = mess;

        setTimeout(function () {
            alertType.style.display = 'none';
        }, 5000);
    }

    document.querySelector('.mdi-close').addEventListener('click', function () {
        var alertType = this.closest('.alert-custom');
        alertType.style.display = 'none';
    });
</script>
