((JQuery) => {
    'use strict'
    $('.navbar-nav li a').on('click', (event) => {
        event.preventDefault();
        let href = event.target.href;
        let targetNode = $('#app-work-space');
        let segments = href.split('/');
        let logout = segments.find((value, index) => {
            if (value === 'logout') {
                return true;
            }
            return false;
        });
        $.ajax({
            async: true,
            url: href,
            dataType: 'html',
            success: (data, textStatus, xhr) => {
                let headers = xhr.getAllResponseHeaders();
                targetNode.html(data);
                if (logout) {
                    window.location = '/';
                }
            }
        });
    });
})();