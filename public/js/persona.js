navigator.id || document.write('<script src="https://login.persona.org/include.js"><\/script>');

$(document).ready(function () {
	$('#login_persona').browserID({
			onlogin : function(response) {
				console.log('login');
				console.log(response);
				window.location.replace('/');
			},
			onfail : function(response) {
				console.log('fail');
				console.log(response);
				$.jGrowl('Problème durant la connexion. Es-tu sûr d\'avoir fourni la même adresse e-mail que celle renseigné dans ton profil ?', {header: 'Erreur'});
			},
			onlogout : function(response) {
			},
			server : '/auth/persona' /* this is the verifier server url */
	});
});