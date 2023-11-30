function getRincian(obj) {
    var id_peminjaman = $(obj).attr('id');
    //console.log(id_peminjaman);
    $.ajax ({
        type: 'POST',
        url: 'http://localhost/dasarWeb/JTInventory/fungsi/modal.php',
        data: 'id=' + id_peminjaman,
        success: function(respons) {
            console.log(respons);
            $('#modalRincian').html(respons);
        }
    })
    $('#modalRincian').modal('show');
}