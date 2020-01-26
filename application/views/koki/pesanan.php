<section id="section1">
	<h5>Pesanan</h5>
	<p class="text-muted font-size-sm" id="total-pesanan">
		Terdapat <b class="text-black-50">0</b> pesanan yang belum dimasak.
	</p>
</section>

<section id="section2">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Makanan / Minuman</th>
			<th scope="col">Meja</th>
			<th scope="col">Jumlah</th>
			<th scope="col">Aksi</th>
		</tr>
		</thead>
		<tbody id="body-pesanan">
		<tr>
			<td colspan="5"><center>Tidak ada pesanan.</center></td>
		</tr>
		</tbody>
	</table>
</section>

<script>
    function get_pesanan() {
        let url = "<?= base_url('koki/get_pesanan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
			data: {},
            success: function (d) {
				let data = d.data.list;
				let a = "";
                for (let i = 0; i < data.length; i++) {
                    let btn = '<div class="list-with-gap">\n' +
                        '              <button type="button" class="btn btn-success btn-xs" onclick="showConfirm(setSelesai,'+ data[i].id +', `Selesai dimasak, Apakah anda yakin?`)">Selesai</button>\n' +
                        '              <button type="button" class="btn btn-danger btn-xs" onclick="showConfirm(setHabis,'+ data[i].id +', `Bahan habis, Apakah anda yakin?`)">Habis</button>\n' +
                        '            </div>';
					a += '<tr>\n' +
                        '\t\t\t<td scope="col">'+ (i+1) +'</td>\n' +
                        '\t\t\t<td scope="col">'+ data[i].nama_menu +'</td>\n' +
                        '\t\t\t<td scope="col">'+ data[i].nomor_meja +'</td>\n' +
                        '\t\t\t<td scope="col">'+ data[i].jumlah +'</td>\n' +
                        '\t\t\t<td scope="col">'+ btn +'</td>\n' +
                        '\t\t</tr>'
                }
                $("#body-pesanan").html(a);
                $("#total-pesanan").html('Terdapat <b class="text-black-50">'+d.data.total+'</b> pesanan yang belum dimasak.')
            }
        });
    }
    get_pesanan();

    function showConfirm (callback) {
        let id = arguments[1];
        let msg = arguments[2];
        new Noty({
            text: '<h5>'+msg+'</h5>',
            buttons: [
                Noty.button('YES', 'btn btn-sm btn-danger rounded-0', function (n) {
                    n.close(); // close noty
                    callback (id);
                }),
                Noty.button('CANCEL', 'btn btn-sm btn-light rounded-0', function (n) {
                    n.close() // close noty
                })
            ]
        }).show()
    }

    function setSelesai(id) {
        let url = "<?= base_url('koki/set_selesai') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id},
            success: function (d) {
                get_pesanan();
            }
        })
    }

    function setHabis(id) {
        let url = "<?= base_url('koki/set_habis') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id},
            success: function (d) {
                get_pesanan();
            }
        })
    }
</script>
