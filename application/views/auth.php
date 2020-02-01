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
	<link rel="stylesheet" href="<?= base_url("assets/plugins/noty/noty.min.css") ?>">
	<!-- CSS plugins goes here -->

	<!-- Main Style -->
	<link rel="stylesheet" href="<?= base_url("assets/css/style.min.css") ?>" id="main-css">
	<link rel="stylesheet" href="#" id="sidebar-css">

	<title>Mimity Admin</title>
</head>

<body class="login-page">

<div class="container pt-5">
	<div class="row justify-content-center">
		<div class="col-md-auto d-flex justify-content-center">
			<div class="card shadow-sm">
				<div class="card-body p-4">
					<!-- LOG IN FORM -->
					<h4 class="card-title text-center mb-0">LOG IN</h4>
					<div class="text-center text-muted font-italic">to your account</div>
					<hr>
					<form id="formLogin">
						<div class="form-group">
							<span class="input-icon">
							  <i class="material-icons">person_outline</i>
							  <input type="text" class="form-control" name="username" placeholder="Username">
							</span>
						</div>
						<div class="form-group">
							<span class="input-icon">
							  <i class="material-icons">lock_open</i>
							  <input type="password" class="form-control" name="password" placeholder="Password">
							</span>
						</div>
						<button type="submit" name="login" class="btn btn-primary btn-block">LOG IN</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Main Scripts -->
<script src="<?= base_url("assets/js/script.js") ?>"></script>

<!-- Plugins -->
<script src="<?= base_url("assets/plugins/noty/noty.min.js") ?>"></script>
<!-- JS plugins goes here -->
<script src="<?= base_url("assets/js/jquery-3.2.1.min.js") ?>"></script>
<script>
    $("#formLogin").on("submit", function (e) {
        e.preventDefault();
        $.ajax({
            url: '<?= base_url("auth/do_login") ?>',
            data: $(this).serialize(),
            dataType: "JSON",
            method: "POST",
            success: function (data) {
                showNotif(data);

                if (data["error"] === 0) {
                    setTimeout(function () {
                        window.location.href = "<? base_url() ?>";
                    }, 1000);
                }
            }
        });
    });

    function showNotif(d) {
        if (d["error"] === 0) {
            new Noty({
                type: 'success',
                text: '<h5>Sukses</h5>' + d["msg"],
                timeout: 1000
            }).show()
        } else {
            new Noty({
                type: 'error',
                text: '<h5>Gagal</h5>' + d["msg"],
                timeout: 2000
            }).show();
        }
    }

</script>

</body>

</html>
