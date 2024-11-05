/**
 * get all paragraphes about explanation
 *
 * const explanationP = document.querySelector('.explanation');
 * const caretUp = document.querySelector('.bi-caret-up-square');
 * const caretDown = document.querySelector('.bi-caret-down-square');
 * const explanationDetails = document.querySelector('.explanation__details');
 *
 * //caretUp.style.display = 'none';
 *
 * explanationP.addEventListener('click', () => {
 *     if (explanationP.style.color === 'rgba(76, 4, 126, 0.92)') {
 *         explanationP.style.color = '';
 *
 *         caretDown.style.display = 'inline';
 *         caretUp.style.display = 'none';
 *
 *         explanationDetails.style.display = 'none';
 *     }
 *     else {
 *         explanationP.style.color = 'rgba(76, 4, 126, 0.92)'; // Applique la couleur violette
 *
 *         caretDown.style.display = 'none';
 *         caretUp.style.display = 'inline';
 *
 *         explanationDetails.style.display = 'block';
 *     }
 * });
 */


/**
 * code fonctionnel
 *
 *
 */
const explanationElements = document.querySelectorAll('.explanation');

explanationElements.forEach(explanationP => {
    explanationP.addEventListener('click', () => {
        // Cibler le bloc de détails correspondant au paragraphe cliqué
        const currentDetailsBlock = explanationP.nextElementSibling;

        // Vérifier si le bloc de détails actuel est déjà visible
        const isCurrentlyVisible = currentDetailsBlock.style.display === 'block';

        // Réinitialiser tous les éléments
        explanationElements.forEach(el => {
            el.style.color = '';
            const downIcon = el.querySelector('.bi-caret-down-square');
            const upIcon = el.querySelector('.bi-caret-up-square');
            if (downIcon && upIcon) {
                downIcon.style.display = 'inline';
                upIcon.style.display = 'none';
            }

            // Cacher tous les blocs de texte
            const detailsBlock = el.nextElementSibling;
            if (detailsBlock) {
                detailsBlock.style.display = 'none';
            }
        });

        // Afficher le bloc de texte lié si ce n'est pas déjà visible
        if (!isCurrentlyVisible) {
            explanationP.style.color = 'rgba(76, 4, 126, 0.92)'; // Applique la couleur violette
            const downIconActive = explanationP.querySelector('.bi-caret-down-square');
            const upIconActive = explanationP.querySelector('.bi-caret-up-square');
            if (downIconActive && upIconActive) {
                downIconActive.style.display = 'none';
                upIconActive.style.display = 'inline';
            }

            // Affiche le bloc de texte lié
            currentDetailsBlock.style.display = 'block';
        } else {
            // Sinon, cacher le bloc si il était déjà visible
            currentDetailsBlock.style.display = 'none';
            explanationP.style.color = ''; // Réinitialiser la couleur
            const downIconActive = explanationP.querySelector('.bi-caret-down-square');
            const upIconActive = explanationP.querySelector('.bi-caret-up-square');
            if (downIconActive && upIconActive) {
                downIconActive.style.display = 'inline';
                upIconActive.style.display = 'none';
            }
        }
    });
});