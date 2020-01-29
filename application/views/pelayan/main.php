<!doctype html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font & Icon -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap"
		  rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">

	<!-- Plugins -->
	<link rel="stylesheet" href="<?= base_url('assets/plugins/noty/noty.min.css') ?>">

	<link rel="stylesheet" href="<?= base_url('assets/plugins/jqvmap/jqvmap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/noty/noty.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/flatpickr/flatpickr.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/flatpickr/plugins/monthSelect/style.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/clockpicker/bootstrap-clockpicker.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/dataTables.bootstrap4.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('assets/plugins/datatables/responsive.bootstrap4.min.css') ?>">

	<!-- Main Style -->
	<link rel="stylesheet" href="<?= base_url('assets/css/style.min.css') ?>" id="main-css">
	<link rel="stylesheet" href="#" id="sidebar-css">

	<title>Warung Bu Broto</title>
</head>

<body>

<!-- Sidebar -->
<div class="sidebar">

	<!-- Sidebar header -->
	<div class="sidebar-header">
		<a href="../index.html" class="logo">
			<img src="<?= base_url('assets/img/logo.svg') ?>" alt="Logo" id="main-logo">
			<?= $sess['jabatan'] ?>
		</a>
		<a href="#" class="nav-link nav-icon rounded-circle ml-auto" data-toggle="sidebar">
			<i class="material-icons">close</i>
		</a>
	</div>
	<!-- /Sidebar header -->

	<!-- Sidebar body -->
	<div class="sidebar-body">
		<ul class="nav nav-sub mt-3" id="menu">
			<li class="nav-item">
				<a class="nav-link has-icon active" href="javascript:void(0)"><i class="fa fa-home"></i>Dashboard</a>
			</li>
			<li class="nav-item">
				<a class="nav-link has-icon" onclick="logout()" href="javascript:void(0)"><i class="material-icons">exit_to_app</i> Logout</a>
			</li>
		</ul>
	</div>
	<!-- /Sidebar body -->

</div>
<!-- /Sidebar -->

<!-- Main -->
<div class="main">

	<!-- Main header -->
	<div class="main-header">
		<a class="nav-link nav-icon rounded-circle" href="#" data-toggle="sidebar"><i
				class="material-icons">menu</i></a>
		<ul class="nav nav-circle nav-gap-x-1 ml-auto"></ul>
		<ul class="nav nav-pills">
			<li class="nav-link-divider mx-2"></li>
			<li class="nav-item dropdown">
				<a class="nav-link has-img px-2" href="#">
					<img src="<?= base_url('assets/img/user.svg') ?>" alt="Admin" class="rounded-circle mr-2">
					<span class="d-none d-sm-block"><?= $_SESSION["nama"] ?></span>
				</a>
			</li>
		</ul>
	</div>
	<!-- /Main header -->

	<!-- Main body -->
	<div class="main-body">

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
					<button id="bt-menu" type="button" class="btn btn-success" disabled>Menu</button>
<!--					<button id="bt-pembayaran" type="button" class="btn btn-primary" disabled>Pembayaran</button>-->
				</div>	</div>
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
				<th scope="col">Aksi</th>
			</tr>
			</thead>
			<tbody id="body-cart">
			<tr>
				<td colspan="7"><center>Meja belum dipilih.</center></td>
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
		">x0</td>
			</tr>
			<tr>
				<td style="
    color: gray;
    font-size: medium;
    width: 150px;
">Total Harga</td>
				<td id="cart-total" style="
    text-align: end;
    font-weight: 600;
    font-size: larger;
">Rp0</td>
			</tr>
		</table>

	</div>
	<!-- /Main body -->


	<!--Modal-->
	<div class="modal fade" id="modalMenu" tabindex="-1" role="dialog" aria-labelledby="basicModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="basicModalLabel">Menu</h5>
					<button class="btn btn-icon btn-sm btn-text-secondary rounded-circle" type="button"
							data-dismiss="modal">
						<i class="material-icons">close</i>
					</button>
				</div>
				<form id="modal-form">

					<div class="modal-body">

						<table class="table">
							<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Makanan / Minuman</th>
								<th scope="col">Harga</th>
								<th scope="col">Aksi</th>
							</tr>
							</thead>
							<tbody id="body-menu"></tbody>
						</table>

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /Main -->

<!-- Backdrop for expanded sidebar -->
<div class="sidebar-backdrop" id="sidebarBackdrop" data-toggle="sidebar"></div>

<!-- Main Scripts -->
<script src="<?= base_url('assets/js/script.min.js')?>"></script>
<script src="<?= base_url('assets/js/app.min.js')?>"></script>

<!-- Plugins -->
<script src="<?= base_url('assets/plugins/jquery-sparkline/jquery.sparkline.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/chart.js/Chart.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<script src="<?= base_url('assets/plugins/noty/noty.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/bootbox/bootbox.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/flatpickr.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/flatpickr/plugins/monthSelect/index.js')?>"></script>
<script src="<?= base_url('assets/plugins/clockpicker/bootstrap-clockpicker.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/datatables/jquery.dataTables.bootstrap4.responsive.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/dateformat.min.js')?>"></script>

<script>
    $("#loadingBox").on("click", function (e) {

        let dialog = bootbox.dialog({
            message: `<div class="d-flex align-items-center">
                      <div class="spinner-border spinner-border-sm mr-2"></div> Mohon menunggu...
                    </div>`
        });
        setTimeout(() => {
            dialog.modal('hide')
        }, 2000)
    });

    function menuOpen(identity, menu) {
        let url = "<?= base_url('pelayan/') ?>"+menu;
        console.log(url);
        $.ajax({
            url: url,
            success: function (page) {
                resetMenu();
                $("#content").html(page);
                identity.addClass("active");
            }
        });
    }

    // menuOpen($(this), "pesanan");

    function resetMenu() {
        $('#pesanan').removeClass("active");
        $('#daftar-pesanan').removeClass("active");
    }

    function logout() {
        let url = "<?= base_url('auth/do_logout') ?>";
        let home = "<?= base_url() ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            success: function () {
                window.location.href = home;
            }
        });
    }

</script>


<script>
    let carts_item = null;
    let nomor_meja = null;

    function get_menu() {
        let nomor_meja = $('#nomor_meja').val();
        let url = "<?= base_url('pelayan/get_menu') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'nomor_meja': nomor_meja},
            success: function (d) {
                a = "";
                for (let i = 0; i < d.length; i++) {
                    a += '<tr>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">'+(i+1)+'</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">'+d[i].nama+'</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col">'+d[i].harga+'</td>\n' +
                        '\t\t\t\t\t\t\t\t<td scope="col"><button type="button" class="btn btn-success btn-xs" onclick="add_menu(\''+d[i].id+'\')">Pilih</button></td>\n' +
                        '\t\t\t\t\t\t\t</tr>'
                }

                $('#body-menu').html(a);
            }
        });
    }

	$('#bt-menu').on("click",function (e) {
        $('#modalMenu').modal('show');
        get_menu();
    });

    function get_meja() {
		nomor_meja = $('#nomor_meja').val();
        let url = "<?= base_url('pelayan/get_meja') ?>";

        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'nomor_meja': nomor_meja},
            success: function (d) {
                loadCart(d.data);
            }
        });
    }

    function loadCart(c) {
        let carts = c.list;

        if (carts.length > 0) {
            carts_item = carts;
            let a = "";
            for (let i = 0; i < carts.length; i++) {
                let status = "";
                let btn = "";
                if (carts[i].status === "0") {
                    status = '<span class="badge badge-danger">batal</span>';
                } else if (carts[i].status === "1") {
                    status = '<span class="badge badge-warning">waiting</span>';
                    btn = '<div class="btn-group" role="group">\n' +
                        '                <button type="button" class="btn btn-text-primary btn-icon rounded-circle" onclick="add(\''+carts[i].id+'\')" ><i class="material-icons">add</i></button>\n' +
                        '                <button type="button" class="btn btn-text-success btn-icon rounded-circle" onclick="minus(\''+carts[i].id+'\')" ><i class="material-icons">remove</i></button>\n' +
                        '                <button type="button" class="btn btn-text-danger btn-icon rounded-circle" onclick="hapus(\''+carts[i].id+'\')" ><i class="material-icons">delete</i></button>\n' +
                        '              </div>'
                } else if (carts[i].status === "2") {
                    status = '<span class="badge badge-primary">proses</span>';
                    btn = '<button type="button" class="btn btn-success btn-xs" onclick="set_selesai(\''+carts[i].id+'\')">Selesai</button>'
                } else if (carts[i].status === "3") {
                    status = '<span class="badge badge-success">selesai</span>';
                }else {
                    status = '<span class="badge badge-secondary">habis</span>';
                }
                let total_harga = carts[i].harga * carts[i].jumlah
                a += "\n" +
                    "\t<tr>\n" +
                    "\t\t<th scope=\"row\">" + (i + 1) + "</th>\n" +
                    "\t\t<td>" + carts[i].nama_menu + "</td>\n" +
                    "\t\t<td class=\"font-number\">" + carts[i].harga + "</td>\n" +
                    "\t\t<td>" + carts[i].jumlah + "</td>\n" +
                    "\t\t<td>"+status+"</td>\n" +
                    "\t\t<td class=\"font-number\">" + total_harga + "</td>\n" +
                    "\t\t<td>"+ btn +"</td>\n" +
                    "\t</tr>"
            }
            $('#body-cart').html(a);
        } else {
            carts_item = null;
            $('#body-cart').html("<tr>\n" +
                "\t\t<th scope=\"row\" colspan=\"7\"><center>Keranjang masih kosong.</center></th>\n" +
                "\t</tr>");
        }

        $('#cart-item').html('x'+c.grand.total_item);
        $('#cart-total').html('Rp'+c.grand.total_harga);

        $('#bt-menu').prop("disabled", false);
        $('#bt-pembayaran').prop("disabled", false);

    }

    function set_selesai(id) {
        let url = "<?= base_url('pelayan/set_selesai') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id, 'nomor_meja': nomor_meja},
            success: function (d) {
                loadCart(d.data);
            }
        });
    }

    function hapus(id) {
        let url = "<?= base_url('pelayan/hapus') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id, 'nomor_meja': nomor_meja},
            success: function (d) {
                loadCart(d.data);
            }
        });
    }

    function add(id) {
        let url = "<?= base_url('pelayan/add') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id, 'nomor_meja': nomor_meja},
            success: function (d) {
                loadCart(d.data);
            }
        });
    }

    function minus(id) {
        let url = "<?= base_url('pelayan/minus') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id, 'nomor_meja': nomor_meja},
            success: function (d) {
                loadCart(d.data);
            }
        });
    }

    function add_menu(id) {
        let url = "<?= base_url('pelayan/add_menu') ?>";
        $.ajax({
            url: url,
            dataType: "JSON",
            method: "POST",
            data: {'id': id, 'nomor_meja': nomor_meja},
            success: function (d) {
                $("#modalMenu").modal("hide");
                loadCart(d.data);
            }
        });
    }

</script>

</body>

</html>
