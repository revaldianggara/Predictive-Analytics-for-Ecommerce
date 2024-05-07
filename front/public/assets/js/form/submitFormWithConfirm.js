$(document).on("submit", ".ajax-form-with-confirm", function (event) {
    event.preventDefault();
    let title = $(this).data("title") ?? "Do you sure?",
        text = $(this).data("text") ?? "",
        confirmButtonText = $(this).data("confirm-button-text") ?? "Yes!",
        cancelButtonText = $(this).data("cancel-button-text") ?? `Cancel.`;
    event.preventDefault();
    Swal.fire({
        icon: "question",
        title,
        text,
        showCancelButton: true,
        confirmButtonText,
        cancelButtonText,
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            submitForm(this);
        }
    });
});

let submitForm = (form_element) => {
  if (typeof loader !== 'undefined') loader.show();
    else if (typeof Loader !== 'undefined') Loader.show();
    return fetchPost($(form_element).attr("action"), new FormData(form_element))
        .then((data) => {
            if (data.redirectUrl) window.location.href = data.redirectUrl;
            else window.location.href = $(form_element).data("redirect");
        })
        .catch(() => {
          if (typeof loader !== 'undefined') loader.hide();
            else if (typeof Loader !== 'undefined') Loader.hide();
        });
};
