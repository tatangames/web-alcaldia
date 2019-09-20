<!DOCTYPE html>
<html lang="es">

<head>
	<title>Acceso</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
		integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<!--Fontawesome CDN-->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
		integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
	<!-- comprimido de librerias -->
	<link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet" />
	<!-- libreria para alertas -->
	<link href="{{ asset('css/alertify.css') }}" type="text/css" rel="stylesheet" />
	<link rel="stylesheet" href="{{asset('css/styleLogin.css')}}">
</head>

<body style="background-image: url({{ asset('images/fondo3.jpg') }}  );">
	<div class="container">
		<div class="d-flex justify-content-center h-100">

			<div class="card " style="height: 450px;">
				<div class="card-header text-center">

					<div class="row text-center d-flex" style="position: relative; top: -70px;">
						<div class="col-md-12">
							<img src="{{ asset('images/LOGO_2_-_copia.png') }}" width="100" height="130px" srcset="">
						</div>
					</div>
					<h3 style="position: relative; top: -10px;">Alcald&iacute;a Municipal</h3>
				</div>
				<div class="card-body">
				<form class=" validate-form">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input id="usuario" type="text" class="form-control" required placeholder="Usuario">
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input id="password" type="password" class="form-control" required placeholder="Contraseña">
					</div>
					<br><br>
					<div class="form-group text-center">
						<input type="button" value="Entrar" id="btnLogin" onclick="login()" class="btn  login_btn">
					</div>
					</form>
				</div>

			</div>
		</div>
	</div>

	<!-- importar axios -->
	<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
	<!-- importar alertas -->
	<script src="{{ asset('js/alertify.js') }}" type="text/javascript"></script>

	<script type="text/javascript">

		// onkey Enter 
         var input = document.getElementById("password");	
			input.addEventListener("keyup", function(event) {	
			if (event.keyCode === 13) {			
				event.preventDefault();			
				login();
			}
		});

		function login() {

			var usuario = document.getElementById('usuario').value;
			var password = document.getElementById('password').value;


			let me = this;
			let formData = new FormData();
			formData.append('usuario', usuario);
			formData.append('password', password);

			var retorno = validaciones(usuario, password);

			if (retorno) {

				// desactivar btnLogin
				document.getElementById("btnLogin").disabled = true;

				axios.post('/admin', formData, {
				})
					.then((response) => {
						// activar btnLogin
						document.getElementById("btnLogin").disabled = false;
						// verificar respuesta
						verificar(response);
					})
					.catch((error) => {
						// activar btnLogin
						document.getElementById("btnLogin").disabled = false;
						alertify.error("Error...");
					});
			}
		}

		// mensajes para verificar respuesta
		function verificar(response) {

			if (response.data.success == 0) {
				alertify.error("Validacion incorrecta...");
			} else if (response.data.success == 1) {
				window.location = response.data.message
			} else if (response.data.success == 2) {
				alertify.error("Contraseña incorrecta");
			} else if (response.data.success == 3) {
				alertify.error("Usuario no encontrado...");
			} else {
				alertify.error("Error");
			}
		}

		// validaciones frontend
		function validaciones(usuario, password) {			
			if (usuario === '') {
				alertify.error("El usuario es requerido...");
				return false;
			}
			else if (password === '') {
				alertify.error("La contraseña es requerida...");
				return false;
			}
			else {
				return true;
			}
		}


	</script>
</body>

</html>