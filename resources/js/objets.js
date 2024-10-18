$(document).ready(function () {
    // Survol des objets pour afficher le customTooltip
    $('.objet-row').hover(function (event) {
        // Récupérer la description à partir de l'attribut data-description
        const description = $(this).data('description');
        console.log('customTooltip data-description: ', description);

        // Vérifier si l'élément customTooltip existe, sinon le créer
        let customTooltip = $('#customTooltip');
        if (customTooltip.length === 0) {
            customTooltip = $('<div id="customTooltip" class="custom-tooltip"></div>').appendTo('body');
        }

        // Ajouter la description au customTooltip
        customTooltip.text(description);

        // Positionner et afficher le customTooltip
        customTooltip.css({
            top: event.pageY + 10 + 'px',
            left: event.pageX + 10 + 'px'
        }).fadeIn(200); // Afficher avec une animation
    }, function () {
        // Cacher le customTooltip lorsque la souris quitte
        $('#customTooltip').fadeOut(200);
    });

    // Déplacer le customTooltip avec la souris
    $('.objet-row').mousemove(function (event) {
        $('#customTooltip').css({
            top: event.pageY + 10 + 'px',
            left: event.pageX + 10 + 'px'
        });
    });
});
