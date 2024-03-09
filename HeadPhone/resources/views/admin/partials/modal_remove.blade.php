

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Xác nhận yêu cầu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modal-body__text">Bạn có chắc chắn muốn xóa không?</p>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="closeModal()" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                <a id="confirmDeleteButton" class="btn btn-danger">Xác nhận</a>
            </div>
        </div>
    </div>
</div>


<script>
    // modal.js
    function openModalRemove(body) {
    var modal = document.getElementById('confirmDeleteModal');
    document.getElementById('modalMessage').innerHTML = body;
    modal.style.display = 'block';
}

function closeModal() {

    $('#confirmDeleteModal').modal('hide');
}

</script>