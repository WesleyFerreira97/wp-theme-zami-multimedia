( () => {
    // opa
    const allCards = document.querySelectorAll('[card-multimedia]');

    const switchPlayer = (cardProps) => {
        const {card:currentCard, info, bar} = cardProps;
        const isCompressed = currentCard.classList.contains('card-inner-info--compressed');
        const currentItemActive = info.classList.contains('active');

        for(const card of allCards) {
            const cardInfo = card.querySelector('[data-card-info]');
            const cardActive = cardInfo.classList.contains('active');

            if(cardActive) {  
                // pausa em midia aqui <<<<<<<<<<<
                if(isCompressed) {
                    const playBar = card.querySelector('[play-bar]');
                    cardInfo.classList.add('close-player');

                    setTimeout(() => {
                        playBar.classList.remove('multimedia_active');
                    }, 1200);
                }

                cardInfo.classList.remove('active', 'open-player');
            }
        }

        if(currentItemActive) {return};

        info.classList.add('active');
        info.classList.remove('close-player');

        if(isCompressed) {
            bar.classList.add('multimedia_active')
            info.classList.add('open-player');
        }
    }

    const cardExpanded = (card, info, bar) => {
        card.classList.remove('card-inner-info--compressed');
        card.classList.add('card-inner-info--expanded');
        
        info.classList.remove('open-player', 'close-player');
        bar.classList.add('multimedia_active');
    }

    const cardCompressed = (card, info, bar) => {
        card.classList.remove('card-inner-info--expanded');
        card.classList.add('card-inner-info--compressed');

        if (!info.classList.contains('active')) {
            bar.classList.remove('multimedia_active');
        }

    }

    const enableClickEvent = (cardProps) => {
        const {button, info} = cardProps;
        const clickEvent = info.classList.contains('event-enabled');

        if(!clickEvent) {
            button.addEventListener('click', () => {
                switchPlayer(cardProps);
            });

            info.classList.add('event-enabled');
        }
    }

    const resizeSettings = (card, info) => {

        if(card.offsetWidth < 800 && info.classList.contains('active')) {
            return info.style.transform = "translate3d(0, -20%, 0)";
        }

        info.style.removeProperty('transform');
    }

    function cardMediator(cardProps) {
        const {card, info, bar} = cardProps;

        enableClickEvent(cardProps);
        resizeSettings(card, info);
        
        card.offsetWidth >= 800 ? cardExpanded(card, info, bar) : cardCompressed(card, info, bar);
    }

    function getAllCards(allCards) {

        for(const card of allCards) {
            const cardProps = {
                card: card,
                info: card.querySelector('[data-card-info]'),
                bar: card.querySelector('.card__info--play-bar'),
                button: card.querySelector('.play-bar__play'),
            }

            cardMediator(cardProps);
            window.addEventListener('resize', () => cardMediator(cardProps));
        }
    }

    getAllCards(allCards);

    
})();



