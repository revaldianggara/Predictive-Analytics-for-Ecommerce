$(document).on("click", ".btn-delete-parent-element", function () {
    const TARGET = $(this).data("parent-target");
    const CALLBACK = $(this).data("callback");
    let title = $(this).data('title') ?? 'Do you sure want to delete?',
    text = $(this).data('text') ?? '';
    Swal.fire({
        icon: "question",
        title,
        text,
        showCancelButton: true,
        confirmButtonText: "Yes!",
        cancelButtonText: `Cancel.`,
    }).then((result) => {
        if (result.isConfirmed) {
            $(this).closest(TARGET).remove();
            if (typeof window[CALLBACK] === "function") {
                window[CALLBACK]();
            }
        }
    });
});
