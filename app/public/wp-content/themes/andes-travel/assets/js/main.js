document.addEventListener('DOMContentLoaded', () => {

    const menuToggle = document.querySelector('.site-header__toggle');
    const navigation = document.querySelector('.site-header__nav');

    if (!menuToggle || !navigation) {
        return;
    }


    menuToggle.addEventListener('click', () => {

        const isOpen = navigation.classList.toggle('is-open');

        menuToggle.setAttribute(
            'aria-expanded',
            isOpen ? 'true' : 'false'
        );

        menuToggle.setAttribute(
            'aria-label',
            isOpen
                ? 'Cerrar menú de navegación'
                : 'Abrir menú de navegación'
        );
    });

    window.addEventListener('resize', () => {

        if (window.innerWidth > 768) {

            navigation.classList.remove('is-open');

            menuToggle.setAttribute(
                'aria-expanded',
                'false'
            );

            menuToggle.setAttribute(
                'aria-label',
                'Abrir menú de navegación'
            );
        }
    });

});