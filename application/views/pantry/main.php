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
		<!-- Button Tab -->
		<div class="btn-group" role="group">
			<button type="button" id="request" class="btn btn-light active">Restok</button>
			<button type="button" id="kebutuhan" class="btn btn-light">Kebutuhan</button>
		</div>

		<br>
		<hr>

		<div id="content"></div>
	</div>
	<!-- /Main body -->

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
        // MENU STAFF
        $('#request').click(function () {
            menuOpen($(this), "request");
        });
        $('#kebutuhan').click(function () {
            menuOpen($(this), "kebutuhan");
        });

        function menuOpen(identity, menu) {
            let url = "<?= base_url('pantry/') ?>"+menu;
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

        menuOpen($(this), "request");

        function resetMenu() {
            $('#request').removeClass("active");
            $('#bahanbaku').removeClass("active");
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

</body>

</html>
