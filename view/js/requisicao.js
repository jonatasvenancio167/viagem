function request(){
	let nome = document.getElementById('nome').value
	let sobrenome = document.getElementById('sobrenome').value
	let email = document.getElementById('email').value
	let telefone = document.getElementById('telefone').value
	let fretcar = document.getElementById('radio_1').value
	let guanabara = document.getElementById('radio_2').value
	let dataViagem = document.getElementById('data').value
	let hora = document.getElementById('hora').value
	let empresa_onibus = document.querySelector('input[name="empresa"]:checked').value
	let cidade = document.getElementById('cidade').value


	if(nome && sobrenome && email && telefone && dataViagem && hora && dataViagem && cidade){
		request_cadastro(nome, sobrenome, email, telefone, empresa_onibus, hora, dataViagem, cidade)
	}
	else{
		alert('algum campo está vázio!')
	}

	event.preventDefault()
}

function somente_numeros(val){
	var evento = val || window.event
	var chave = evento.keyCode || theEvent.which
	chave = String.fromCharCode( chave )

	var regex = /^[0-9.]+$/
	if(!regex.test(chave)){
		evento.returnValue = false
		if(evento.preventDefault) evento.preventDefault()
	}
}

function format(str){
	let clear = ('' + str).replace(/\D/g, '')
	let match = clear.match(/^(\d{3})(\d{3})(\d{4})$/)

	if(match){
		return '(' + match[1] + ') ' + match[2] + '-' + match[3];
	}
	return null
}

function request_cadastro(nome, sobrenome, email, telefone, empresa_onibus, hora, data, cidade){
	$.ajax({
		method: "POST",
		url: `http://localhost:8080/controller/Viagem.php`,
		data: JSON.stringify({ nome:  nome, sobrenome: sobrenome, email: email, telefone: telefone, 
			empresa_onibus: empresa_onibus, hora: `${hora}:00`, data: data, cidade_destino: cidade }),
		crossDomain: true,
		contentType: "application/json; charset=utf-8",
		success: function(data){
			alert('O cadastro foi realizado com sucesso')
		},
		error: function(data){
			alert('Ocorreu um erro durante o cadastro, por gentileza, cadastre-se novamente!')
		}
	})
}



