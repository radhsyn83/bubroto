<section id="section1" xmlns="http://www.w3.org/1999/html">
	<h5>Kasir Pembayaran</h5>
	<p class="text-muted font-size-sm" id="total-request">
		Silahkan masukkan nomor meja.
	</p>
</section>

<section id="section2">
	<div class="row">
		<div class="col-3">
			<div class="input-group">
				<input id="nomor_meja" type="text" class="form-control" placeholder="Nomor meja">
				<div class="input-group-append">
					<button onclick="get_meja()" class="btn btn-light" type="button">Set</button>
				</div>
			</div>
		</div>
		<div class="col-9">
			<div class="list-with-gap">
				<button id="bt-bayar" type="button" class="btn btn-primary" disabled onclick="showPembayaran()">Bayar
				</button>
			</div>
		</div>
	</div>

	<br>

	<table class="table">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Makanan / Minuman</th>
			<th scope="col">Satuan</th>
			<th scope="col">Jumlah</th>
			<th scope="col">Status</th>
			<th scope="col">Total Harga</th>
		</tr>
		</thead>
		<tbody id="body-cart">
		<tr>
			<td colspan="7">
				<center>Meja belum dipilih.</center>
			</td>
		</tr>
		</tbody>
	</table>
	<br>
	<table>
		<tr>
			<td style="
    color: gray;
    font-size: medium;
    width: 150px;
">Total Jumlah
			</td>
			<td id="cart-item" style="
		text-align: end;
		font-weight: 600;
		font-size: larger;
		">x0
			</td>
		</tr>
		<tr>
			<td style="
    color: gray;
    font-size: medium;
    width: 150px;
">Total Harga
			</td>
			<td id="cart-total" style="
    text-align: end;
    font-weight: 600;
    font-size: larger;
">Rp0
			</td>
		</tr>
	</table>

	</div>
	<!-- /Main body -->


	<!--Modal-->
	<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel"
		 aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="title-pembayaran">Pembayaran Meja: #0</h5>
					<button class="btn btn-icon btn-sm btn-text-secondary rounded-circle" type="button"
							data-dismiss="modal">
						<i class="material-icons">close</i>
					</button>
				</div>
				<form id="pembayaran-form">

					<div class="modal-body">
						<div class="form-group">
							<label for="f_metode">Metode Pembayaran</label>
							<select type="text" class="form-control" id="f_metode" name="f_metode">
								<option val="CASH">CASH</option>
								<option val="DEBIT">DEBIT</option>
							</select>
						</div>
						<div class="form-group">
							<label for="f_harga">Total Harga</label>
							<input type="text" class="form-control" id="f_harga" name="f_harga" disabled placeholder="0"
						</div>
						<input type="hidden" class="form-control" id="f_meja" name="f_meja" placeholder="0"
						<div class="form-group">
							<label for="f_bayar">Bayar</label>
							<input type="text" class="form-control" id="f_bayar" name="f_bayar" placeholder="0">
						</div>
						<div class="form-group">
							<label for="f_kembalian">Kembalian</label>
							<input type="text" class="form-control" id="f_kembalian" name="f_kembalian" disabled
								   placeholder="0">
						</div>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-success" id="bt-pay" disabled>Bayar</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<script>
    var selectedMeja = null;
    var selectedCart = null;

    function get_meja() {
        nomor_meja = $('#nomor_meja').val();
        let url = "<?= base_url('kasir/get_meja') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            beforeSend: function () {
                $("#bt-bayar").prop("disabled", true);
            },
            data: {'nomor_meja': nomor_meja},
            success: function (d) {
                if (d.error === 0) {
                    $("#bt-bayar").prop("disabled", false);
                    selectedMeja = nomor_meja;
                    selectedCart = d;

                    loadCart(d.data)
                } else {
                    selectedMeja = null;
                    $("#body-cart").html('' +
                        '<tr>\n' +
                        '\t\t\t<td colspan="7"><center>' + d.msg + '</center></td>\n' +
                        '\t\t</tr>' +
                        '')
                }
            }
        });
    }

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


    function loadCart(c) {
        let carts = c.list;

        if (carts.length > 0) {
            carts_item = carts;
            let a = "";
            for (let i = 0; i < carts.length; i++) {
                let status = "";
                if (carts[i].status === "0") {
                    status = '<span class="badge badge-danger">batal</span>';
                } else if (carts[i].status === "1") {
                    status = '<span class="badge badge-warning">waiting</span>';
                } else if (carts[i].status === "2") {
                    status = '<span class="badge badge-primary">proses</span>';
                    btn = '<button type="button" class="btn btn-success btn-xs" onclick="set_selesai(\'' + carts[i].id + '\')">Selesai</button>'
                } else if (carts[i].status === "3") {
                    status = '<span class="badge badge-success">selesai</span>';
                } else {
                    status = '<span class="badge badge-secondary">habis</span>';
                }
                let total_harga = carts[i].harga * carts[i].jumlah
                a += "\n" +
                    "\t<tr>\n" +
                    "\t\t<th scope=\"row\">" + (i + 1) + "</th>\n" +
                    "\t\t<td>" + carts[i].nama_menu + "</td>\n" +
                    "\t\t<td class=\"font-number\">" + carts[i].harga + "</td>\n" +
                    "\t\t<td>" + carts[i].jumlah + "</td>\n" +
                    "\t\t<td>" + status + "</td>\n" +
                    "\t\t<td class=\"font-number\">" + total_harga + "</td>\n" +
                    "\t</tr>"
            }
            $('#body-cart').html(a);
        } else {
            carts_item = null;
            $('#body-cart').html("<tr>\n" +
                "\t\t<th scope=\"row\" colspan=\"7\"><center>Keranjang masih kosong.</center></th>\n" +
                "\t</tr>");
        }

        $('#cart-item').html('x' + c.grand.total_item);
        $('#cart-total').html('Rp' + c.grand.total_harga);

        $('#bt-pembayaran').prop("disabled", false);

    }

    function showPembayaran() {
        var total = selectedCart.data.grand
        $("#modalPembayaran").modal("show")
        $("#title-pembayaran").html("Nomor Meja: <b>#" + selectedMeja + "</b>");
        $("#f_harga").val(total.total_harga);
        $("#f_meja").val(selectedMeja);
        $("#f_bayar").val("");
    }

    function currency(nom) {
        const value = nom.replace(/,/g, '');
        var r = parseFloat(value).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 0,
            minimumFractionDigits: 0
        });

        return r
    }

    $("#f_bayar").on("keyup", function (e) {
        var b = $(this).val();
        var total = (selectedCart.data.grand.total_harga).replace(",", "")
        if (b == "") {
            $(this).val(currency(0))
            $("#f_kembalian").val("0")
            $("#bt-pay").prop("disabled", true)
        } else {
            $(this).val(currency(b))
            var kembali = parseInt(b.replace(",", "")) - parseInt(total)
            $("#f_kembalian").val(kembali)


            if (kembali >= 0) {
                $("#bt-pay").prop("disabled", false)
            } else {
                $("#bt-pay").prop("disabled", true)
            }
        }

    })

    $("#pembayaran-form").on("submit", function (e) {
        e.preventDefault()

        new Noty({
            text: '<h5>Apakah anda yakin?</h5>',
            buttons: [
                Noty.button('YES', 'btn btn-sm btn-danger rounded-0', function (n) {
                    n.close(); // close noty
                    bayar()
                }),
                Noty.button('CANCEL', 'btn btn-sm btn-light rounded-0', function (n) {
                    n.close() // close noty
                })
            ]
        }).show()
    })

    function bayar(f) {
        let url = "<?= base_url('kasir/bayar') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: $("#pembayaran-form").serialize(),
            success: function (d) {
				clearAll()
				console.log(d)
				$("#modalPembayaran").modal("hide")
				openInvoice(d.data)
            }
        });
    }

    function openInvoice(id) {
        let url = "<?= base_url('invoice/pembayaran/') ?>"+id;
        var win = window.open(url, '_blank');
        win.focus();
    }

    function clearAll() {
        $('#body-cart').html("<tr>\n" +
            "\t\t<th scope=\"row\" colspan=\"7\"><center>Meja belum dipilih.</center></th>\n" +
            "\t</tr>");

        $('#cart-item').html('x' + 0);
        $('#cart-total').html('Rp' + 0);
        $('#nomor_meja').val("");
        $('#bt-bayar').prop("disabled", true);
    }

</script>
