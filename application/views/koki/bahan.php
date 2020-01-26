<section id="section1">
	<h5>Bahan Baku</h5>

	<button type="button" class="btn btn-primary btn-sm" onclick="showModal()">Tambah Bahan Baku</button>
	<br>
	<br>

</section>

<section id="section2">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">Satuan</th>
			<th scope="col">Aksi</th>
		</tr>
		</thead>
		<tbody id="body-bahan">
		<tr>
			<td colspan="4">
				<center>Tidak ada Menu.</center>
			</td>
		</tr>
		</tbody>
	</table>
</section>

<!--Modal-->
<div class="modal fade" id="modalBahanBaku" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="container">
				<br>
				<h5 id="basicModalLabel" id="bahan-title">Bahan Baku</h5>
			</div>

			<form id="bahan-form">

				<div class="modal-body">
					<input type="hidden" class="form-control" id="f_id" name="f_id">
					<input type="hidden" class="form-control" id="f_id_menu" name="f_id_menu">
					<div class="form-group">
						<label for="f_nama">Nama</label>
						<input type="text" class="form-control" id="f_nama" name="f_nama"
							   placeholder="Masukkan nama">
					</div>
					<div class="form-group">
						<label for="f_satuan">Satuan</label>
						<input type="text" class="form-control" id="f_satuan" name="f_satuan"
							   placeholder="Masukkan satuan">
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="bahan-btn">Tambah Bahan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
    var jsonBahan = "";

    function get_bahan() {
        let url = "<?= base_url('koki/get_list_bahan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {},
            success: function (d) {
                jsonBahan = d.data;
				let a = ""
                for (let i = 0; i < jsonBahan.length; i++) {
                    let btn = '<div class="list-with-gap">\n' +
                        '              <button type="button" class="btn btn-success btn-xs" onclick="showModal(`' + i + '`)">Ubah</button>\n' +
                        '              <button type="button" class="btn btn-danger btn-xs" onclick="showConfirm(hapusBahan,' + jsonBahan[i].id + ', `Bahan akan dihapus, Apakah anda yakin?`)">Hapus</button>\n' +
                        '            </div>';
                    a += '<tr>\n' +
                        '\t\t\t<td scope="col">' + (i + 1) + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonBahan[i].nama + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonBahan[i].satuan + '</td>\n' +
                        '\t\t\t<td scope="col">' + btn + '</td>\n' +
                        '\t\t</tr>'
                }
                $("#body-bahan").html(a);
            }
        });
    }

    get_bahan()

    function showConfirm(callback) {
        let id = arguments[1];
        let msg = arguments[2];
        new Noty({
            text: '<h5>' + msg + '</h5>',
            buttons: [
                Noty.button('YES', 'btn btn-sm btn-danger rounded-0', function (n) {
                    n.close(); // close noty
                    callback(id);
                }),
                Noty.button('CANCEL', 'btn btn-sm btn-light rounded-0', function (n) {
                    n.close() // close noty
                })
            ]
        }).show()
    }

    function showModal(index) {
        $("#modalBahanBaku").modal("show")
        if (index != null) {
            $("#bahan-btn").html("Ubah Bahan")
            $("#f_id").val(jsonBahan[index].id)
            $("#f_nama").val(jsonBahan[index].nama);
            $("#f_satuan").val(jsonBahan[index].satuan)
        } else {
            $("#bahan-btn").html("Tambah bahan")
            $("#f_id").val("")
            $("#f_nama").val("");
            $("#f_satuan").val("")
        }
    }

    function hapusBahan(id) {
        let url = "<?= base_url('koki/hapusBahanBaku') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id},
            success: function () {
                get_bahan()
            }
        })
    }

    $("#bahan-form").on("submit", function (e) {
        e.preventDefault();
        let url = "<?= base_url('koki/addOrUpdateBahanBaku') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                get_bahan()
            }
        })

        $("#modalBahanBaku").modal("hide")
    })
</script>
