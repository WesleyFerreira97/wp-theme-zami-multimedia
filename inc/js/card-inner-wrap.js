// Status atual da merda : 
// Função playerActiveResize, ativada pelo resize, ativando a classe open-player e gerando bug visual de animação
// Botão de play - Evento de click não está sendo removido devidamente e gerando bugs quando : a pagina é iniciada no compressed redimensionada para o expanded e botão de play presionado, ativa a função toggle container
// Adição e remoção da classe multimedia_active em momentos indevidos


const cardItems = document.querySelectorAll('[card-multimedia]');
const cardsInfo = document.querySelectorAll('[data-card-info]');
let clickEvent = false;

function openPlayer(cardItems, cardsInfo){

    // Fecha qualquer item que esteja previamente ativo                 
    // Abre o item atual clicado caso já não esteja aberto
    function toggleContainer(currentItem) {
        const {item, info, bar, button} = currentItem; 
        // const currentItemActive = item.classList.contains('active');
        const isCompressed = item.classList.contains('card-inner-info--compressed');

        if(!isCompressed) {
            return;
        }

        for (card of cardsInfo) {
            if(card.classList.contains('active')) {
                const previousPlayBar = card.querySelector('[play-bar]');
                
                card.classList.add('close-player');
                card.classList.remove('active', 'open-player');

                setTimeout(() => {
                    previousPlayBar.classList.remove('multimedia_active');
                }, 1200);
                return;
            }
        }

        // Se o item atual clicado for o ativo, fecha e finaliza a função
        // if(currentItemActive) {
        //     return
        // }

        info.classList.remove('close-player');
        bar.classList.add('multimedia_active');
        info.classList.add('active', 'open-player');
    }

    const cardExpanded = (card) => {
        const {item, info, bar, button} = card;

        item.classList.remove('card-inner-info--compressed');
        item.classList.add('card-inner-info--expanded');

        info.classList.remove('open-player', 'close-player');
        bar.classList.add('multimedia_active');
    }

    const cardCompressed = (card) => {
        const {item, button} = card;

        item.classList.remove('card-inner-info--expanded');
        item.classList.add('card-inner-info--compressed');
    }

    const playerActiveResize = (card) => {
        const {info} = card;
        info.classList.add('open-player');
        cardCompressed(card);
    }

    // Clean class of animation and active
    // Toggle class expanded e compressed
    function getAllCards(cards){ 
        
        for ( let item of cards ) {
            
            const cardWidth = item.offsetWidth;
            const card = {
                item: item,
                info: item.querySelector('[data-card-info]'),
                bar: item.querySelector('.card__info--play-bar'),
                button: item.querySelector('.play-bar__play'),
            }

            if(!clickEvent) {
                card.button.addEventListener('click', () => {
                    toggleContainer(card);
                });
                clickEvent = true;
            }
           
            if(cardWidth <= 800 && card.info.classList.contains('active')) {
                playerActiveResize(card);
                
                continue;
            }
               
            if (cardWidth >= 800) {
                cardExpanded(card);

                continue;
            }

            cardCompressed(card);

            // Remove classes e deixa o elemento padrão no caso de resize
            card.info.classList.remove('open-player', 'close-player', 'active');
            card.bar.classList.remove('multimedia_active');
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
