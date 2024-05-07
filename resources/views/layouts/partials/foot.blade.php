<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="{{ asset('assets/js/material-dashboard.min.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('top-js')

<script>
    var globalURL = 'http://rest-api-arneva.test/api';
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
        damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
@stack('bottom-js')
<script>
    function confirmDelete(id, url) {
        if (confirm('Are you sure you want to delete this data?')) {
            deleteData(id, url);
        }
    }

    function deleteData(id, url) {
        $.ajax({
            url: `${url}`,
            type: 'DELETE',
            data: {},
            success: function(response) {
                alert('Data deleted successfully!');
                getData();
            },
            error: function(xhr, status, error) {
                alert('Failed to delete data!');
            }
        });
    }
</script>
