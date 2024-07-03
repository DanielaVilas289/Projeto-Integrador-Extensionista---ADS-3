function confirmarExclusao(event) {
  var resposta = confirm('Tem certeza de que seja excluir este professor?')

  // cancela o evento de envio do formulário caso a resposta tenha sido negativa
  if (resposta == false) {
    event.preventDefault()
  }
}
