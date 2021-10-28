// Status atual da merda : 
// Função playerActiveResize, ativada pelo resize, ativando a classe open-player e gerando bug visual de animação
// Botão de play - Evento de click não está sendo removido devidamente e gerando bugs quando : a pagina é iniciada no compressed redimensionada para o expanded e botão de play presionado, ativa a função toggle container
// Adição e remoção da classe multimedia_active em momentos indevidos


const cardItems = document.querySelectorAll('[card-multimedia]');
const cardsInfo = document.querySelectorAll('[data-card-info]');

function openPlayer(cardItems, cardsInfo){

    function toggleContainer(currentItem) {
        const {item, info, bar} = currentItem; 
        const isExpanded = item.classList.contains('card-inner-info--expanded');
        const currentItemActive = info.classList.contains('active');

        // Fechar item anteriormente ativo
        for (card of cardsInfo) {
            if(card.classList.contains('active')) {
                const previousPlayBar = card.querySelector('[play-bar]');

                card.classList.remove('active', 'open-player');
                
                if(!isExpanded) {
                    card.classList.add('close-player');
                    setTimeout(() => {
                        previousPlayBar.classList.remove('multimedia_active');
                    }, 1200);
                }
            }
        }
        
        bar.classList.add('multimedia_active');

        if(currentItemActive) {
            return;
        }

        info.classList.add('active');
        info.classList.remove('close-player');

        if(!isExpanded ) {
            info.classList.add('open-player');
        }
    }

    const cardExpanded = (card) => {
        const {item, info, bar} = card;

        item.classList.remove('card-inner-info--compressed');
        item.classList.add('card-inner-info--expanded');
        
        info.classList.remove('open-player', 'close-player');
        bar.classList.add('multimedia_active');
    }

    const cardCompressed = (card) => {
        const {item, info, bar} = card;

        item.classList.remove('card-inner-info--expanded');
        item.classList.add('card-inner-info--compressed');

        if (!info.classList.contains('active')) {
            bar.classList.remove('multimedia_active');
        }
    }

    const playerActiveResize = (card) => {
        const {info, width} = card;

        if(width < 800 && info.classList.contains('active')) {
            return info.style.transform = "translate3d(0, -20%, 0)";
        }

        info.style.removeProperty('transform');
    }

    function getAllCards(cards){ 
        
        for ( let item of cards ) {
            const card = {
                item: item,
                info: item.querySelector('[data-card-info]'),
                bar: item.querySelector('.card__info--play-bar'),
                button: item.querySelector('.play-bar__play'),
                width: item.offsetWidth,
            }

            const {info, button, width} = card;
            
            const clickEventt = info.classList.contains('event-enabled');

            if(!clickEventt) {
                button.addEventListener('click', () => {
                    toggleContainer(card);
                });
                info.classList.add('event-enabled');
            }

            width >= 800 ? cardExpanded(card) : cardCompressed(card);
           
            playerActiveResize(card);
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
// ( function( $ ) {
//     const getBody = document.querySelector('body');

//     $( window ).on( 'elementor/frontend/init', function() {

//         elementorFrontend.hooks.addAction( 'frontend/element_ready/Zami_grid_cards_inner_2.default', function($scope, $){

//             if(getBody.classList.contains("elementor-editor-active")) {
        
//                 const cardItemsElEditor = $scope.find('[card-multimedia]');
//                 const cardsInfoElEditor = $scope.find('[data-card-info]');

//                 openPlayer(cardItemsElEditor, cardsInfoElEditor);
//             }

//         }); 
//     })

// } )( jQuery );
