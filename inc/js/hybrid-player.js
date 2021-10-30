(function () {
    let playerWrap = document.querySelectorAll('[data-player]');
    
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

    function initPlayer(playerElements) {
        
        for(const player of playerElements) {
            const getMedia = player.querySelector('[data-media]');

            if(!getMedia) { return }

            const mediaNodes = getMedia.childNodes;
            let i;

            for (i = 0; i < mediaNodes.length; i++) {

                let mediaType = mediaNodes[i].nodeName.toUpperCase();
                let media = getMedia.querySelector(mediaType);

                switch (mediaType) {
                    case 'AUDIO':
                    setControls(media, player, mediaType);    
                    break;

                    case 'VIDEO': 
                        console.log('video');
                    break;
                    
                    case 'IFRAME': 
                        console.log('iframe');
                    break;
                }
            }
        };
    };

    initPlayer(playerWrap);

    // Elementor Editor and Preview
    // ( function( $ ) {
    //     const getBody = document.querySelector('body');

    //     $( window ).on( 'elementor/frontend/init', function() {

    //         elementorFrontend.hooks.addAction( 'frontend/element_ready/Zami_grid_cards_inner_2.default', function($scope, $){

    //             if(getBody.classList.contains("elementor-editor-active")) {
            
    //                 const cardItemsElEditorr = $scope.find('[data-player]');
    //                 initPlayer(cardItemsElEditorr);
    //             }

    //         }); 
    //     })

    // } )( jQuery );


})();
