( () => {
    const allCards = document.querySelectorAll('[card-multimedia]');
    const aceptedMedias = ['VIDEO', 'AUDIO', 'IFRAME'];
    let currentMedia = [];
    
    let play = (media) => {
        let paused = media.paused;

        if (paused == true) {
            media.play();
            return
        }
        media.pause();
    }
 
    let returnTime = (media) => {
        let getTime = media.currentTime;
        let setTime = getTime - 15;
    
        media.currentTime = setTime;
    };

    let advanceTime = (media) => {
        let getTime = media.currentTime;
        let setTime = getTime + 15;
    
        media.currentTime = setTime;
    };

    let rangeBarTime = (media, currentTimeBar) => {
        media.currentTime = currentTimeBar;
    };

    let setVolume = (media, currentVolume) => {
        media.volume = currentVolume;
    }

    let showTime = (media, displayTime) => {
        let currentSecs = media.currentTime;
        let hours = Math.floor(currentSecs / 3600);
        let minutes = Math.floor((currentSecs - (hours * 3600)) / 60);
        let seconds = Math.floor(currentSecs - (hours * 3600) - (minutes * 60));

        if(seconds < 10) {
            seconds = "0" + seconds;
        }

        if(minutes < 10) {
            minutes = "0" + minutes;
        }

        displayTime.innerHTML = hours + ':' + minutes + ':' + seconds;
    }

    let changeSpeed  = (media, speedButton) => {
        
        let currentSpeed = 0;

        speedButton.addEventListener('click', () => {
     
            let velocities = [1, 1.25, 1.5, 1.75, 2];
            
            currentSpeed += 1;

            if(currentSpeed > velocities.length -1) {
               currentSpeed = 0;
            }   

            speedButton.innerHTML = velocities[currentSpeed] + 'x';
            return media.playbackRate = velocities[currentSpeed];
        });
    }

    function setControls(media, controls,  mediaType) {
        const playButton = controls.querySelector('[data-control="play"]');
        const returnTimeButton = controls.querySelector('[data-control="return-time"]');
        const advanceTimeButton = controls.querySelector('[data-control="advance-time"]');
        const timeBar = controls.querySelector('[data-control="time-bar"]');
        const currentTime = controls.querySelector('[data-control="current-time"]');
        const volume = controls.querySelector('[data-control="volume"]');
        const speed = controls.querySelector('[data-control="speed"]');

        let checkMidia = media.ended;

        if(checkMidia == true) {
            console.log('acabou samerda');
        }

        changeSpeed(media, speed);

        currentTime.innerHTML = '0:00:00';

        media.ontimeupdate = () => {
            showTime(media, currentTime);
            timeBar.value = media.currentTime
        }

        media.onloadedmetadata = function() {
            let mediaDuration = media.duration;

            timeBar.min = 0;
            timeBar.max = mediaDuration; 
            volume.min = 0;
            volume.max = 1.0;
            volume.step = 0.1;
        };
        
        playButton.addEventListener('click', () => {
            play(media)
        });

        returnTimeButton.addEventListener('click', () => {
            returnTime(media)
        });

        advanceTimeButton.addEventListener('click', () => {
            advanceTime(media)
        });

        timeBar.addEventListener('change', (e) => {
            let currentTimeBar = e.target.value;
            rangeBarTime(media, currentTimeBar)
        });

        volume.addEventListener('change', (e) => {
            let currentVolume = e.currentTarget.value;
            setVolume(media, currentVolume)
        });
    }

    const switchPlayer = (cardProps) => {
        // inserir objeto media e implementar play/pause 
        const {card:currentCard, info, bar, media, mediaType} = cardProps;
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
        const {card, info, bar, media, mediaType} = cardProps;

        enableClickEvent(cardProps);
        resizeSettings(card, info);

        if(media) {
            setControls(media, card, mediaType);
            currentMedia.push({media, mediaType});
        }
        console.log(currentMedia);
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

            const getMedia = card.querySelector('[data-media]');
            
            if(getMedia) { 
                // Get media and set in main Object
                const mediaNodes = getMedia.childNodes;

                for (const node of mediaNodes) { 
                    const nodeType = node.nodeName.toUpperCase();
                    const mediaType = aceptedMedias.find( media => media == nodeType);
                    const media = getMedia.querySelector(mediaType);

                    if(mediaType) {
                        cardProps['mediaType'] = mediaType;
                        cardProps['media'] = media;
                    }
                }

             }

            cardMediator(cardProps);
            window.addEventListener('resize', () => cardMediator(cardProps));
        }
    }
    
    getAllCards(allCards);
})();
