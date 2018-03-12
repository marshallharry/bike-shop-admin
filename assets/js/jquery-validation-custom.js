$(function() {
    jQuery.extend(jQuery.validator.messages, {
        required: "Kolom ini harus diisi.",
        date: "Format tanggal salah (e.g. 2018-01-31).",
        number: "Kolom ini harus berupa angka."
    });
});