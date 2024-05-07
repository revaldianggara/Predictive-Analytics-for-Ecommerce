function fetch_post(url, body, header = {}, options = {}) {
    return fetch(url, {
        headers: {
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            ...header
        },
        body,
        method: 'post',
        ...options
    })
        .then(resp => resp.json());
}
