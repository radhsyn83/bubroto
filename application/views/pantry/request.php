<section id="section1">
	<h5>Request Koki</h5>
	<p class="text-muted font-size-sm" id="total-request">
		Terdapat <b class="text-black-50">0</b> jenis bahan yang harus direstok.
	</p>
</section>

<section id="section2">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">Kebutuhan</th>
			<th scope="col">Aksi</th>
		</tr>
		</thead>
		<tbody id="body-request">
		<tr>
			<td colspan="4">
				<center>Tidak ada Request.</center>
			</td>
		</tr>
		</tbody>
	</table>
</section>

<script>
    var jsonRequest = "";

    function get_request() {
        let url = "<?= base_url('pantry/get_request') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {},
            success: function (d) {
                jsonRequest = d.data.list;
                let a = ""
                for (let i = 0; i < jsonRequest.length; i++) {

                    console.log(jsonRequest[i].request);
                    let btn = '<div class="list-with-gap">\n' +
                        '              <button type="button" class="btn btn-success btn-xs" onclick="showConfirm(setUpdate,'+ jsonRequest[i].id +', `Apakah anda yakin?`)">Update Stok</button>\n' +
                        '            </div>';
                    a += '<tr>\n' +
                        '\t\t\t<td scope="col">' + (i + 1) + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonRequest[i].nama + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonRequest[i].kebutuhan + ' ' + jsonRequest[i].satuan + '</td>\n' +
                        '\t\t\t<td scope="col">' + btn + '</td>\n' +
                        '\t\t</tr>'
                }
                $("#body-request").html(a);
                $("#total-request").html('Terdapat <b class="text-black-50">'+ d.data.total +'</b> jenis bahan yang harus direstok')
            }
        });
    }

    get_request()

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

    function setUpdate(id) {
        let url = "<?= base_url('pantry/set_update') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id},
            success: function () {
                get_request();
            }
        })
    }
</script>
