(() => {
    'use strict'
    const nav = document.querySelector('.navbar-nav');
    let tabs  = nav.querySelectorAll(':scope > li');
    nav.addEventListener('click', (event) => {
        if (event.target.matches('.navbar-nav li a')) {
            //alert('target found');
        }
    });
    console.log(tabs, 'tabs');
})();