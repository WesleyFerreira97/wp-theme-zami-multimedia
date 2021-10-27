
const cardItems = document.querySelectorAll('[card-multimedia]');
const cardsInfo = document.querySelectorAll('[data-card-info]');

function openPlayer(cardItems, cardsInfo){


    
    // Fecha qualquer item que esteja previamente ativo                 
    // Abre o item atual clicado caso já não esteja aberto
    function switchContainer(currentItem) {
        const currentItemActive = currentItem.classList.contains('active');
        const playBar = currentItem.querySelector('[play-bar]');
        
        // Fecha qualquer item que esteja ativo
        for (info of cardsInfo) {
            if(info.classList.contains('active')) {
                const previousPlayBar = info.querySelector('[play-bar]');

                info.classList.add('close-player');
                info.classList.remove('active', 'open-player');

                setTimeout(() => {
                previousPlayBar.classList.remove('multimedia_active');
                }, 1200);
            }
        }

        // Se o item atual clicado for o ativo, fecha e finaliza a função
        if(currentItemActive) {
            return
        }
        
        playBar.classList.add('multimedia_active');
        currentItem.classList.remove('close-player');
        currentItem.classList.add('active', 'open-player');
    }

    // Clean class of animation and active
    // Toggle class expanded e compressed
    function getAllCards(cards){ 
        
        for ( let item of cards ) {
            let clickEventActive = false;
            const cardWidth = item.offsetWidth;
            const cardInfo = item.querySelector('[data-card-info]');
            const playBar = item.querySelector('.card__info--play-bar');
            const playButton = item.querySelector('.play-bar__play');

            const card = {
                info: item.querySelector('[data-card-info]'),
                bar: item.querySelector('.card__info--play-bar'),
                button: item.querySelector('.play-bar__play'),
            }
            // if(cardInfo.classList.contains('active')) {
            //     continue;
            // }
            
            if (cardWidth > 800) {
                clickEventActive = false;

                playButton.removeEventListener('click', switchContainer);
                playBar.classList.add('multimedia_active');
                item.classList.remove('card-inner-info--compressed');
                item.classList.add('card-inner-info--expanded');
                continue;
            }

            // Card Compressed Settings
            if(!clickEventActive) {
                playButton.addEventListener('click', () => {
                    switchContainer(cardInfo)
                });
                
                clickEventActive = true;
    }

            // Remove classes e deixa o elemento padrão no caso de resize
            cardInfo.classList.remove('open-player', 'close-player', 'active');
            playBar.classList.remove('multimedia_active');

            item.classList.remove('card-inner-info--expanded');
            item.classList.add('card-inner-info--compressed');

        }
    }

    // Init card
    getAllCards(cardItems);
    
    window.addEventListener('resize', () => {
        getAllCards(cardItems);
    });
}

openPlayer(cardItems, cardsInfo);

// Elementor Editor and Preview
( function( $ ) {
    const getBody = document.querySelector('body');

    $( window ).on( 'elementor/frontend/init', function() {

        elementorFrontend.hooks.addAction( 'frontend/element_ready/Zami_grid_cards_inner_2.default', function($scope, $){

            if(getBody.classList.contains("elementor-editor-active")) {
        
                const cardItemsElEditor = $scope.find('[card-multimedia]');
                const cardsInfoElEditor = $scope.find('[data-card-info]');

                openPlayer(cardItemsElEditor, cardsInfoElEditor);
            }

        }); 
    })

} )( jQuery );
