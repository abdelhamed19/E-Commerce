<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    // Wait for the document to be ready
    $(document).ready(function () {
        // Check if the flash message exists
        var flashMessage = $('.alert');

        // If the flash message exists, hide it after 5 seconds
        if (flashMessage.length > 0) {
            setTimeout(function () {
                flashMessage.alert('close');
            }, 2000);
        }
    });
</script>
<style>
    /* Custom very green color for success alert */
    .alert-success {
        color: #edf8f0; /* Text color */
        background-color: #28a745; /* Very green background color */
        border-color: #218838; /* Border color */
    }
</style>

@if(session($type))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session($type) }}
</div>
@endif

