function ajax_select2(el, url, options = {}) {
    $(document).ready(function () {
        $(el).select2({
            theme: 'bootstrap4',
            ajax: {
                url,
                dataType: 'json',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                data: function (term) {
                    return (JSON.stringify({
                        keyword: term.term
                    }))
                },
                processResults: function (data) {
                    return {
                        results: data
                    }
                }
            },
            ...options
        });
    });
}
