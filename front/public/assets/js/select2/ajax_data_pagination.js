function ajax_select2_pagination(el, url, options = {}, ajaxOptions = {}) {
    return $(el).select2({
        theme: 'bootstrap4',
        ajax: {
            url,
            dataType: 'json',
            headers: {
                'Content-Type': 'application/json'
            },
            type: "GET",
            data: function (term) {
                return {
                    keyword: term.term,
                    page: term.page || 1
                }
            },
            processResults: function (data) {
                return {
                    pagination: {
                        more: data.next_page_url != null
                    },
                    results: data.data
                }
            },
            ...ajaxOptions
        },
        ...options
    });
}
