const fetchPost = (url, body, header = {}, options = {}) => {
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
        .then(resp => {
            if (!resp.ok) {
                return resp.json().then(data => {
                    throw data.message ?? data;
                });
            } else
                return resp.json()
        })
        .catch(err => {
            Toast.error(err,"",{
                timeOut: 5000
            });
            throw err;
        });
}
