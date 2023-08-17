const prevControl = document.querySelector('.carousel-control-prev');
        const nextControl = document.querySelector('.carousel-control-next');

        // Show navigation controls on mouse enter
        prevControl.addEventListener('mouseenter', () => {
            prevControl.classList.remove('hidden');
        });

        nextControl.addEventListener('mouseenter', () => {
            nextControl.classList.remove('hidden');
        });

        // Hide navigation controls on mouse leave
        prevControl.addEventListener('mouseleave', () => {
            prevControl.classList.add('hidden');
        });

        nextControl.addEventListener('mouseleave', () => {
            nextControl.classList.add('hidden');
        });