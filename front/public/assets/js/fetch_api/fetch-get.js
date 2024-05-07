function fetch_get(url, header = {}, options = {}) {
    return fetch(url, {
        headers: {
            'Accept': 'application/json',
            ...header
        },
        ...options
    })
        .then(resp => resp.json());
}
