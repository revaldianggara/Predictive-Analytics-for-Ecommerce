const datatable_ajax_data = (d) => {
    $(`[data-target*='datatable-filter']`).each((i, element) => {
        d[$(element).attr("name")] = $(element).val();
    });
};
let $datatable = {
    reload() {
        this.obj.draw();
    },
};
const init_serverside_datatable = (el, url, columns, options = {}) => {
    $datatable.obj = $(el).DataTable({
        bSortCellsTop: true,
        processing: true,
        serverSide: true,
        searching: false,
        ajax: {
            url: url,
            data: datatable_ajax_data,
        },
        columns: [
            {
                data: null,
                sortable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            },
            ...columns,
        ],
        language: {
            // info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            // infoEmpty: "Menampilkan _PAGE_ sampai _PAGES_ entri",
            paginate: {
                // next: "Selanjutnya",
                // previous: "Sebelumnya"
            },
            processing:
                '<div class="spinners"><div class="spinner-grow text-success" role="status">\n                            <span class="sr-only">Loading...</span>\n                         </div>\n                         <div class="spinner-grow text-danger" role="status">\n                             <span class="sr-only">Loading...</span>\n                         </div>\n                         <div class="spinner-grow text-warning" role="status">\n                             <span class="sr-only">Loading...</span>\n                         </div></div>',
        },
        lengthChange: false,
        ...options,
    });

    return $datatable.obj;
};

const init_datatable = (el, url, columns, options = {}) => {
    $(el).DataTable({
        bSortCellsTop: true,
        searching: true,
        ...options,
    });
};
