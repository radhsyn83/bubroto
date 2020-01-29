<section id="section1">
	<h5>Kebutuhan</h5>
	<p class="text-muted font-size-sm" id="total-request">
		Daftar bahan yang dibutuhkan koki untuk masak.
	</p>
</section>

<section id="section2">
	<table class="table">
		<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Nama</th>
			<th scope="col">Kebutuhan</th>
		</tr>
		</thead>
		<tbody id="body-kebutuhan">
		<tr>
			<td colspan="4">
				<center>Tidak ada Request.</center>
			</td>
		</tr>
		</tbody>
	</table>
</section>

<script>
    var jsonKebutuhan = "";

    function get_kebutuhan() {
        let url = "<?= base_url('pantry/get_kebutuhan') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {},
            success: function (d) {
                jsonKebutuhan = d.data;
                console.log(jsonKebutuhan);
                let a = ""
                for (let i = 0; i < jsonKebutuhan.length; i++) {

                    a += '<tr>\n' +
                        '\t\t\t<td scope="col">' + (i + 1) + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonKebutuhan[i].nama + '</td>\n' +
                        '\t\t\t<td scope="col">' + jsonKebutuhan[i].kebutuhan + ' ' + jsonKebutuhan[i].satuan + '</td>\n' +
                        '\t\t</tr>'
                }
                $("#body-kebutuhan").html(a);
            }
        });
    }

    get_kebutuhan()

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
</script>
