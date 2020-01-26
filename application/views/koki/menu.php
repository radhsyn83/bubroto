<section id="section1">
	<h5>Menu</h5>
	<p class="text-muted font-size-sm">
		Tambah menu dan bahan baku menu.
	</p>

	<button type="button" class="btn btn-primary btn-sm" onclick="showModalMenu()">Tambah Menu</button>
	<br>
	<br>

</section>

<section id="section2">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Makanan / Minuman</th>
			<th scope="col">Harga</th>
			<th scope="col">Aksi</th>
		</tr>
		</thead>
		<tbody id="body-menu">
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
				<h5 id="basicModalLabel">Bahan Baku</h5>
				<p class="text-muted font-size-sm" id="modal-title">
					Tambah menu dan bahan baku menu.
				</p>
				<button type="button" class="btn btn-primary btn-sm" onclick="showBahanAddEdit()">Tambah</button>
			</div>
			<form id="modal-form">

				<div class="modal-body">

					<table class="table">
						<thead>
						<tr>
							<th scope="col">#</th>
							<th scope="col">Bahan</th>
							<th scope="col">Kebutuhan</th>
							<th scope="col">Aksi</th>
						</tr>
						</thead>
						<tbody id="body-bahan"></tbody>
					</table>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel"
	 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="container">
				<br>
				<h5 id="basicModalLabel" id="menu-title">Menu</h5>
			</div>

			<form id="menu-form">
				<div class="modal-body">
					<input type="hidden" class="form-control" id="m_id" name="m_id">
					<div class="form-group">
						<label for="m_nama">Nama</label>
						<input type="text" class="form-control" id="m_nama" name="m_nama"
							   placeholder="Masukkan nama menu"/>
					</div>
					<div class="form-group">
						<label for="m_harga">Harga</label>
						<input type="text" class="form-control" id="m_harga" name="m_harga"
							   placeholder="Masukkan harga menu"/>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" id="menu-btn">Tambah Menu</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!--Modal-->
<div class="modal fade" id="modalBahanBakuAdd" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel"
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
						<label for="f_nama">Bahan</label>
						<select class="form-control" id="f_id_bahan" name="f_id_bahan"></select>
					</div>
					<div class="form-group">
						<label for="f_kebutuhan">Jumlah Kebutuhan</label>
						<input type="text" class="form-control" id="f_kebutuhan" name="f_kebutuhan"
							   placeholder="Masukkan jumlah kebutuhan">
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
    var jsonMenu = "";
    var jsonBahanBaku = "";
    var selectedMenu = "";

    function get_menu() {
        let url = "<?= base_url('koki/get_menu') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {},
            success: function (d) {
                jsonMenu = d.data;

                let a = "";
                for (let i = 0; i < jsonMenu.length; i++) {
                    let btn = '<div class="list-with-gap">\n' +
                        '              <button type="button" class="btn btn-success btn-xs" onclick="showModalMenu(`' + i + '`)">Ubah</button>\n' +
                        '              <button type="button" class="btn btn-danger btn-xs" onclick="showConfirm(hapusMenu,' + jsonMenu[i].id + ', `Menu akan dihapus, Apakah anda yakin?`)">Hapus</button>\n' +
                        '              <button type="button" class="btn btn-info btn-xs" onclick="showBahan(`' + i + '`)">Bahan Baku</button>\n' +
                        '            </div>';
                    a += '<tr>\n' +
                        '\t\t\t<td scope="col">' + (i + 1) + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonMenu[i].nama + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonMenu[i].harga + '</td>\n' +
                        '\t\t\t<td scope="col">' + btn + '</td>\n' +
                        '\t\t</tr>'
                }
                $("#body-menu").html(a);
            }
        });
    }

    get_menu();

    function get_list_bahan() {
        let url = "<?= base_url('koki/get_list_bahan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {},
            success: function (d) {
                let data = d.data;

                let a = "";
                for (let i = 0; i < data.length; i++) {
                    a += '<option value="' + data[i].id + '">' + data[i].nama + '</option>';
                }
                $("#f_id_bahan").html(a);
            }
        });
    }

    get_list_bahan()

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

    function showModalMenu(index) {
        $("#modalMenu").modal("show")
        if (index != null) {
            $("#menu-title").html("Ubah Menu")
            $("#menu-btn").html("Ubah Menu")
            $("#m_id").val(jsonMenu[index].id)
            $("#m_nama").val(jsonMenu[index].nama);
            $("#m_harga").val(jsonMenu[index].harga)
        } else {
            $("#menu-title").html("Tambah Menu")
            $("#menu-btn").html("Tambah Menu")
            $("#m_id").val("")
            $("#m_nama").val("");
            $("#m_harga").val("")
        }
    }

    function showBahan(index) {
        selectedMenu = index
        $("#modalBahanBaku").modal("show")
        get_bahan(index)
    }

    function get_bahan(index) {
        let url = "<?= base_url('koki/get_bahan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {"id": jsonMenu[selectedMenu].id},
            success: function (d) {
                jsonBahanBaku = d.data;
                let a = "";
                for (let i = 0; i < jsonBahanBaku.length; i++) {
                    let btn = '<div class="list-with-gap">\n' +
                        '                <button type="button" class="btn btn-text-success btn-icon rounded-circle" onclick="showBahanAddEdit(\'' + i + '\', \'' + jsonMenu[index].id + '\')" ><i class="material-icons">create</i></button>\n' +
                        '                <button type="button" class="btn btn-text-danger btn-icon rounded-circle" onclick="showConfirm(hapusBahan,' + jsonBahanBaku[i].id + ', `Bahan akan dihapus, Apakah anda yakin?`)" ><i class="material-icons">delete</i></button>\n' +
                        '            </div>';
                    a += '<tr>\n' +
                        '\t\t\t<td scope="col">' + (i + 1) + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonBahanBaku[i].nama + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonBahanBaku[i].kebutuhan + ' ' + jsonBahanBaku[i].satuan + '</td>\n' +
                        '\t\t\t<td scope="col">' + btn + '</td>\n' +
                        '\t\t</tr>'
                }
                $("#body-bahan").html(a);
                $("#modal-title").html(jsonMenu[index].nama);
            }
        });
    }

    function showBahanAddEdit(index) {
        $("#modalBahanBakuAdd").modal("show")
        $("#f_id_menu").val(jsonMenu[selectedMenu].id)
        if (index != null) {
            $("#bahan-title").html("Ubah Bahan")
            $("#bahan-btn").html("Ubah Bahan")
            $("#f_id").val(jsonBahanBaku[index].id)
            $("#f_id_bahan").val(jsonBahanBaku[index].id_bahan);
            $("#f_kebutuhan").val(jsonBahanBaku[index].kebutuhan)
        } else {
            $("#bahan-title").html("Tambah Bahan")
            $("#bahan-btn").html("Tambah Bahan")
            $("#f_id").val("")
            $("#f_id_bahan").val(jsonBahanBaku[0].id_bahan);
            $("#f_kebutuhan").val("")
        }
    }

    $("#bahan-form").on("submit", function (e) {
        e.preventDefault();
        let url = "<?= base_url('koki/addOrUpdateBahan') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                get_bahan(selectedMenu)
            }
        })

        $("#modalBahanBakuAdd").modal("hide")
    })

    $("#menu-form").on("submit", function (e) {
        e.preventDefault();
        let url = "<?= base_url('koki/addOrUpdateMenu') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: $(this).serialize(),
            success: function () {
                get_menu()
            }
        })

        $("#modalMenu").modal("hide")
    })

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

    function hapusMenu(id) {
        let url = "<?= base_url('koki/hapusMenu') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id},
            success: function () {
                get_menu()
            }
        })
    }

    function hapusBahan(id) {
        let url = "<?= base_url('koki/hapusBahan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id},
            success: function () {
                get_bahan(selectedMenu)
            }
        })
    }
</script>
