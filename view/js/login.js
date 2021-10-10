function login(){

	let user = document.getElementById('email').value
	let password = document.getElementById('password').value

	if(user && password){
		request_login(login, password)
	}

	event.preventDefault()
}

function request_login(login, password){
	$.ajax({
		method: 'POST',
		url: 'http://localhost:8080/controller/Login.php',
		data: JSON.stringify({login: login, password: password}),
		crossDomain: true,
		contentType: "application/json; charset=utf-8",
		success: function(data){
			alert('Login efetuado com sucesso!')
		},
		error: function(data){
			alert('Email ou Senha não confere!')
		}
	})
}
