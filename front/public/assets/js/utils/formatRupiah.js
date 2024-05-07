function formatRupiah(el) {
    let nilaiKlaim = $(el).val();

    // Remove non-numeric characters
    nilaiKlaim = nilaiKlaim.replace(/\D/g, "");

    if (nilaiKlaim !== "") {
        nilaiKlaim = parseInt(nilaiKlaim, 10);

        if (!isNaN(nilaiKlaim)) {
            // Format the number as RUPIAH with dot in every 3 digits
            nilaiKlaim = nilaiKlaim.toLocaleString("id-ID");
        }
    }

    $(el).val(nilaiKlaim);
}

$(".format-rupiah").on("input", function () {
    formatRupiah($(this));
});
