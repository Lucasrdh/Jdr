$(document).ready(function() {
    const tooltip = $('<div class="tooltip"></div>'); // Crée un élément div pour le tooltip
    $('body').append(tooltip); // Ajoute le tooltip au corps de la page

    // Lorsqu'on survole une ligne du tableau
    $('.objet-row').hover(function(event) {
        const description = $(this).data('description'); // Récupère la description de l'objet
        tooltip.text(description); // Remplit le tooltip avec la description

        // Montre le tooltip et le place près de la souris
        tooltip.show().css({
            top: event.pageY + 10 + 'px', // Positionne légèrement en dessous de la souris
            left: event.pageX + 10 + 'px'
        });
    }, function() {
        tooltip.hide(); // Cache le tooltip lorsqu'on ne survole plus l'élément
    });

    // Déplace le tooltip avec la souris
    $('.objet-row').mousemove(function(event) {
        tooltip.css({
            top: event.pageY + 10 + 'px',
            left: event.pageX + 10 + 'px'
        });
    });
});
