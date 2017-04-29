'use strict';

{
    var ui_navigation = document.querySelectorAll('.sub-navigation');
    if (ui_navigation) {
        ui_navigation.forEach(function (nav) {
            nav.addEventListener('click', function () {
                nav.classList.toggle('sub-navigation--show');
                nav.querySelector('.mdl-navigation__link').classList.toggle('mdl-navigation__link--current');
            });
        });
    }
}