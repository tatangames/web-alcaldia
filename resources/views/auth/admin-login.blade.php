<!DOCTYPE html>
<html lang="es">
<head>
	<title>Acceso</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- comprimido de librerias -->
	<link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet" />
	<!-- libreria para alertas -->
	<link href="{{ asset('css/alertify.css') }}" type="text/css" rel="stylesheet" />
	
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url({{ asset('images/bg-01.jpg') }}  );">
			<div class="wrap-login100">

				<form class="login100-form validate-form">
				<!-- token de seguridad para ataques tipo csrf -->
				@csrf
					<span class="login100-form-logo">
						<i class="zmdi zmdi-landscape"></i>
					</span>

					<span class="login100-form-title p-b-34 p-t-27">
						Sitio Web
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" id="usuario" name="usurio" placeholder="Usuario">
						<span class="focus-input100" data-placeholder="&#xf207;"></span>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="password" id="password" name="password" placeholder="Contraseña">
						<span class="focus-input100" data-placeholder="&#xf191;"></span>
					</div>

					<div class="container-login100-form-btn">
						<button id="btnLogin" onclick="login()" type="button" class="login100-form-btn">
							Iniciar Sesión
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- importar axios -->
	<script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
	<!-- importar alertas -->
	<script src="{{ asset('js/alertify.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/sweetalert2.all.js') }}" type="text/javascript"></script>

	<script type="text/javascript">
	
		function login(){

			var usuario = document.getElementById('usuario').value; 
			var password = document.getElementById('password').value; 


			let me = this;
			let formData = new FormData();
			formData.append('usuario', usuario);
			formData.append('password', password);

			var retorno = validaciones(usuario, password);

			if(retorno){

			// desactivar btnLogin
			document.getElementById("btnLogin").disabled = true;   

			axios.post('/admin', formData, {  
				})
				.then((response) => {	
					document.getElementById("btnLogin").disabled = false; 
					verificar(response);
				})
				.catch((error) => {
					// activar btnLogin
					document.getElementById("btnLogin").disabled = false;   
					alertify.error("Error...");          
				}); 
			}
		}

		function mensajeFire(tipo, mensaje){
				Swal.fire({          
				type: tipo,
				title: mensaje,
				showConfirmButton: false,
				timer: 1500
			});
		}
            

		function verificar(response){
			
			if(response.data.success == 0){  
				alertify.error("Validacion incorrecta...");
			}else if(response.data.success == 1){
				window.location = response.data.message
			}else if(response.data.success == 2){
				alertify.error("Contraseña incorrecta...");
			}else if(response.data.success == 3){
				alertify.error("Usuario no encontrado...");
			}else {
				alertify.error("Error");
			}
		}

		function validaciones(usuario, password){  
            if(usuario === ''){
                alertify.error("El usuario es requerido...");
                return false;
            }
            else if(password === ''){
                alertify.error("La contraseña es requerida...");
                return false;
            }           
            else{
                return true;
            }
        } 

	
	</script>





</body>
</html>