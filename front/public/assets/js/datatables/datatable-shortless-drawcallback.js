const shortless_drawcallback = (table) => {
    $(table).find('tbody').find('.text-read-more').map(function () {
        str = $(this).html();
        if (str.length > 50) {
            str.substr(0, 49) +
                '...<a href="#" data-str="" class="moreless">Selanjutnya</a>'
            var shh = `
                    <span>` + str.substr(0, 49) + `</span><span class="dots">...</span><span class="nextless" style="display:none;">` + str.substr(49, str.length) + `</span>
                    <span class="btn-toggle-readmore" style="color:blue;">More</span>
                `;
            $(this).html(shh);
        }
    }).get();

    $('.btn-toggle-readmore').on('click', function () {
        if ($(this).text() == 'More') {
            $(this).parent().find('.dots').hide();
            $(this).parent().find('.nextless').show();
            $(this).text('Less').css('color', 'red')
        } else {
            $(this).parent().find('.dots').show();
            $(this).parent().find('.nextless').hide();
            $(this).text('More').css('color', 'blue')
        }
    });
}
