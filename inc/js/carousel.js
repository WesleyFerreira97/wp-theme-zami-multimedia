(function () {
    var moving = true;

    function disableInteraction() {
        moving = true;
        setTimeout(function () {
            moving = false;
        }, 1000);
    }

    var controlPrev = document.querySelectorAll('[data-control="prev"]');
    var controlNext = document.querySelectorAll('[data-control="next"]');
    var carouselIndex = document.querySelectorAll('[data-index="carousel"]');

    // Detectar tipo de botão clicado
    // Detectar o node atual vinculado ao botão
    function controls(control) {

        control.forEach(function (button) {
            // Type Button
            let typeButton = button.dataset.control;
            // Carousel node ID
            let carouselTarget = button.dataset.carousel;
            // Carousel Element
            let carouselItems = document.getElementById(carouselTarget);

            button.addEventListener('click', function () {

                if (!moving) {
                    disableInteraction();
                    currentElement(typeButton, carouselItems);
                    setIndex(carouselIndex);
                }
            });
        });
    }

    // Detect Current Item (Index)
    // Aciona função referente ao botão clicado
    function currentElement(typeButton, items) {
        let elements = items.getElementsByClassName('carousel__item');
        let i;

        for (i = 0; i < elements.length; i++) {
            let currentElement = elements[i].classList.contains('carousel__item--active');

            if (currentElement == true) {
                actionButton(typeButton, i, elements);
                break;
            }
        }
    }

    function setIndex(elIndex) {

        elIndex.forEach(function (elements) {
            let carouselName = elements.dataset.carousel;
            let carouselElement = document.getElementById(carouselName);
            let carouselItems = carouselElement.getElementsByClassName("carousel__item");
            let i;

            for (i = 0; i < carouselItems.length; i++) {
                let currentElement = carouselItems[i].classList.contains('carousel__item--active');

                if (currentElement == true) {
                    let itemsLength = carouselItems.length;
                    let currentIndex = i + 1;
                    
                    elements.innerHTML = currentIndex + '&nbsp / &nbsp' + itemsLength;
                    
                    // Show next item title 
                    let currentItem = carouselItems[i].nextElementSibling;
                    
                    if (currentItem == null) {
                        currentItem = carouselItems[0];
                    }
                    
                    let elementTitle = currentItem.getElementsByClassName("component-info__title")[0].textContent;
                    let elementInfo = document.querySelectorAll('[data-info="carousel"]');

                    elementInfo.forEach(function(el) {
                        el.innerHTML = elementTitle;
                        
                    })
                }
            }
        });
    }

    // Retorna um novo index
    // Retorna os items do carousel atual 
    function actionButton(typeButton, index, elements) {
        let newIndex;
        let item = 'carousel__item uk-grid-collapse uk-grid ';
        let itemActive = ' carousel__item--active ';
        let fadeOut;
        let fadeIn;
        
        if (typeButton == 'next') {
            if (index == (elements.length - 1)) {
                newIndex = 0;
            } else {
                newIndex = index + 1;
            }
            
            fadeOut = 'fade__out--left';
            fadeIn = 'fade__in--left'
        }

        if (typeButton == 'prev') {
            if (index == 0) {
                newIndex = elements.length - 1;
            } else {
                newIndex = index - 1;
            }

            fadeOut = 'fade__out--right';
            fadeIn = 'fade__in--right'
        }

        elements[index].className = item + fadeOut;
        elements[newIndex].className = item + fadeIn + itemActive;
    }
 
    function initCarousel() {
        controls(controlPrev);
        controls(controlNext);
        setIndex(carouselIndex);
        // Enable controls
        moving = false;
    }

    initCarousel();

}()); // Function


