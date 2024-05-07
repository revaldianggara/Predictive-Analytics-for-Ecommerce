$(document).on("submit", ".ajax-form", function (event) {
    event.preventDefault();
    submitForm(this);
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
