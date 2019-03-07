/*==========================================================================*\
 *																			*
 *   Toggle.js PROJET 4 - Billet Simple pour l'Alaska - ADRIEN MORIM	    *
 *																			*
\*==========================================================================*/

let toggle = {

    initToggle: function(){
        let button = $('#navbar-button');
        let content = $('#navbar-content');
        let overlay = $('#navbar-overlay');
        let link = $('#icon-link');
        let icon = $('#icon-button');

        // Controle souris
        button.on('click', function() {
            //On verifie le Noeud parent
            //console.log(this.parentNode);

            // On ajoute la class active
            button.toggleClass('active');
            content.toggleClass('active');
            overlay.toggleClass('overlay-active');
            link.toggleClass('active');
            icon.toggleClass('fa-times').toggleClass('fa-bars');
        });

        overlay.on('click', function() {
            button.removeClass('active');
            content.removeClass('active');
            overlay.removeClass('overlay-active');
            link.removeClass('active');
            icon.removeClass('fa-times').addClass('fa-bars');
        });

        // Controle clavier
        // entrée keyCode: 13;
        // esc keyCode: 27;
        $(document).on('keydown', function(e) {
            if (e.which == 13 || e.keyCode == 13){
                // On ajoute la class active
                content.toggleClass('active');
                overlay.toggleClass('overlay-active');
            } else if (e.which == 27 || e.keyCode == 27){
                content.removeClass('active');
                overlay.removeClass('overlay-active');
                icon.removeClass('fa-times').addClass('fa-bars');
            }
        });
    }
};