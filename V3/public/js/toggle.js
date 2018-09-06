/*==========================================================================*\
 *																			*
 *   Toggle.js PROJET 4 - Billet Simple pour l'Alaska - ADRIEN MORIM	    *
 *																			*
\*==========================================================================*/

var toggle = {

    initToggle: function(){
        var button = $('#navbar-button');
        var content = $('#navbar-content');
        var overlay = $('#navbar-overlay');
        var icon = $('#icon-button');

        // Controle souris
        button.on('click', function() {
            // On verifie le Noeud parent
            //console.log(this.parentNode);

            // On ajoute la class active
            content.toggleClass('active');
            overlay.toggleClass('overlay-active');
            if (icon)
            icon.addClass('fa-times');
            icon.removeClass('fa-bars');
        });

        overlay.on('click', function() {
            content.toggleClass('active');
            overlay.toggleClass('overlay-active');
            icon.addClass('fa-bars');
            icon.removeClass('fa-times');

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
            }
        });
    }
}