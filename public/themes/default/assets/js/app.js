(() => {
    'use strict'
    const nav = document.querySelector('.navbar-nav');
    let tabs  = nav.querySelectorAll(':scope > li');
    nav.addEventListener('click', (event) => {
        if (event.target.matches('.navbar-nav li a')) {
            //alert('target found');
            event.preventDefault();
            const request = new XMLHttpRequest();
            request.open('GET', event.target.href, true);
            request.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            request.send();
        }
    });
    console.log(tabs, 'tabs');
})();