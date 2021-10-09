function request(){
	let nome = document.getElementById('nome').value
	let sobrenome = document.getElementById('sobrenome').value
	let email = document.getElementById('email').value
	let telefone = document.getElementById('telefone').value
	let fretcar = document.getElementById('radio_1').value
	let guanabara = document.getElementById('radio_2').value
	let dataViagem = document.getElementById('data').value
	let hora = document.getElementById('hora').value
	let empresa_onibus
	let select = document.getElementById('cidade')
	let valor = select.options[select.selectedIndex]

	if(nome && sobrenome && email && telefone && dataViagem && hora){
		request_cadastro(nome, sobrenome, email, telefone, dataViagem, hora)
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

function request_cadastro(nome, sobrenome, email, telefone, empresa_onibus, hora, data){
	$.ajax({
		method: "POST",
		url: `localhost:8000/controller/Viagem.php`,
		data: ({ nome:  nome, sobrenome: sobrenome, email: email, telefone: telefone, empresa_onibus: empresa_onibus, hora: `${hora}:00`, data: data }),
		success: function(data){
			alert(data)
		},
		error: function(data){
			alert(data)
		}
	})
}

// function request_cidade(){
// 	$.ajax({
// 		method: "POST",
// 		url: `localhost:8000/controller/Cidades.php`,
// 		data: ({id: id, cidade: cidade}),
// 		success: function(data){
// 			alert(data)
// 		},
// 		error: function(data){
// 			alert(data)
// 		}
// 	})
// }


