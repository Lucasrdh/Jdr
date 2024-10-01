document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.competence-checkbox');
    const modificateurTotalSpan = document.getElementById('modificateur-total');
    const modificateurAttaqueSpan = document.getElementById('modificateur-attaque');
    const modificateurDefenseSpan = document.getElementById('modificateur-defense');

    // Initialisation des modificateurs
    let baseModificateur = 2 + (niveau - 1) * 2; // Modificateur de base
    let totalAttaque = baseModificateur; // Modificateur d'attaque total
    let totalDefense = baseModificateur; // Modificateur de défense total

    // Appliquer les modificateurs des équipements
    equipements.forEach(equipement => {
        const modificateur = equipement.modificateur || 0; // Assure que le modificateur existe
        const type = equipement.type_modificateur || 'Attaque'; // Assure que le type existe
        if (type === 'Attaque') {
            totalAttaque += modificateur;
        } else if (type === 'Défense') {
            totalDefense += modificateur;
        }
    });

    // Fonction pour mettre à jour les modificateurs
    function updateModificateurs() {
        let baseModificateurActuel = baseModificateur; // Conserve le modificateur de base
        let modificateurAttaqueActuel = totalAttaque; // Démarre avec le total d'attaque
        let modificateurDefenseActuel = totalDefense; // Démarre avec le total de défense

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const modificateurCompetence = parseInt(checkbox.getAttribute('data-modificateur'));
                const typeModificateur = checkbox.getAttribute('data-type');

                // Gérer les modificateurs selon leur type
                if (typeModificateur === 'Attaque') {
                    modificateurAttaqueActuel += modificateurCompetence; // Ajoute au modificateur d'attaque
                } else if (typeModificateur === 'Défense') {
                    modificateurDefenseActuel += modificateurCompetence; // Ajoute au modificateur de défense
                } else if (!typeModificateur || typeModificateur.trim() === '') {
                    // Augmente à la fois attaque, défense et total si type_modificateur est null ou vide
                    baseModificateurActuel += modificateurCompetence; // Augmente la base
                    modificateurAttaqueActuel += modificateurCompetence; // Augmente aussi l'attaque
                    modificateurDefenseActuel += modificateurCompetence; // Augmente aussi la défense
                } else {
                    // Cas où le type de modificateur est spécifié mais non reconnu
                    baseModificateurActuel += modificateurCompetence; // Augmente le modificateur de base
                }
            }
        });

        // Appliquer les malus
        baseModificateurActuel -= malus;
        modificateurAttaqueActuel -= malus;
        modificateurDefenseActuel -= malus;

        // Met à jour l'affichage
        modificateurTotalSpan.innerText = baseModificateurActuel; // Affiche le modificateur de base
        modificateurAttaqueSpan.innerText = modificateurAttaqueActuel; // Affiche le modificateur d'attaque
        modificateurDefenseSpan.innerText = modificateurDefenseActuel; // Affiche le modificateur de défense
    }

    // Ajout des événements sur les checkboxes
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateModificateurs);
    });

    // Initialisation de l'affichage
    updateModificateurs();
});
