function exibeCandidatos(candidatos) {
  let html = ''
  candidatos.map((candidato) => {
      html += "<div class='card'>" + '<h2>' + candidato.nome + '</h2><br><p>' + candidato.desc + '</p><br>' 
      + '<div class="info">' + '<h4>Número do Candidato: ' + candidato.numero + '</h4><h4>Votos: ' + candidato.votos 
      + '</h4><a class="btn" href="http://localhost:5000/votar.php?id=' + candidato.id + '">Votar</a>' + '</div></div>' ; 
  });
  console.log(html);
  document.getElementById('mostrar').innerHTML = html;
}
  
function consultaCandidatos() {    
  const url = 'http://localhost:5000/consultacandidatos.php';

  fetch(url)
    .then((response) => {
      if(response.status >= 200 && response.status < 300) {
        return response.json();
      }
      throw new Error(response.statusText);
    })
    .then((candidatos) => {
      console.log(candidatos);
      exibeCandidatos(candidatos);
    })
    .catch((error) => {
      console.log(error);
    });
}
  
  