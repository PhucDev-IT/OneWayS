<div class="modal" id="modal-loading">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center">
                <div class="loading-spinner mb-2"></div>
                <div>Loading</div>
            </div>
        </div>
    </div>
</div>


<style>
    .modal-dialog {
        display: flex;
        justify-content: center;
       
    }

    .modal-content {
        position: relative;
        display: flex;
        flex-direction: column;
        pointer-events: auto;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid #e8eff9;
        border-radius: 0.3rem;
        outline: 0;
        max-width: 50%;
    }

    .loading-spinner {
        width: 30px;
        height: 30px;
        border: 2px solid indigo;
        border-radius: 50%;
        border-top-color: #0001;
        display: inline-block;
        animation: loadingspinner .7s linear infinite;
    }

    @keyframes loadingspinner {
        0% {
            transform: rotate(0deg)
        }

        100% {
            transform: rotate(360deg)
        }
    }
</style>

<script>
    $(function() {
        $('#modal-loading').modal('hidden');
    });
</script>