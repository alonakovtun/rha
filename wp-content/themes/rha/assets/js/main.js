import { ready } from "./utils";

(function () {
    ready(() => {

        function setCookie(cname, cvalue) {
            var d = new Date();
            d.setTime(d.getTime() + 354 * 24 * 60 * 60 * 1000);
            var expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=" + cvalue + "; " + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(";");
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == " ") c = c.substring(1);
                if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
            }
            return "";
        }

        function bookmark() {
            var current_page = $('.site').attr('id')



            $(window).on('load', function () {
                loadState(current_page);
            });

            $('.content p').each((index, element) => {
                $(element).on('click', () => {
                    $('.content p').each((i, e) => {
                        console.log(e)
                        $(e).removeClass('saved');
                    }) // if you need to close other sub-menu

                    $(element).toggleClass('saved');

                    saveState(current_page);

                })
            })

            // refreshPage();


            // Fold or unfold each content based on state before refresh
            // And go to same scroll position before refresh
            function loadState(page_id) {
                let hidden_states = getCookie('hidden-states-' + page_id);
                if (!hidden_states) {
                    return;
                }

                document.scrollingElement.scrollLeft = getCookie('scroll-x-' + page_id);
                document.scrollingElement.scrollTop = getCookie('scroll-y-' + page_id);

                hidden_states = hidden_states.split(',');
                $('.content p').each(function (i, elem) {
                    if (hidden_states[i] === 'saved') {
                        elem.classList.add('saved');
                    }
                    else {
                        elem.classList.remove('saved');
                    }
                });
            }

            // Remember fold & unfold states, and scroll positions
            function saveState(page_id) {
                let hidden_states = [];
                $('.content p').each(function (i, elem) {
                    hidden_states.push(elem.classList.contains('saved') ? 'saved' : 'show');
                });

                setCookie('hidden-states-' + page_id, hidden_states);
                setCookie('scroll-x-' + page_id, document.scrollingElement.scrollLeft);
                setCookie('scroll-y-' + page_id, document.scrollingElement.scrollTop);
            }
        }

        function initSiteCookiesBannerScripts() {
            const cookiesBannerEl = document.querySelector(".cookie-block");

            if (cookiesBannerEl) {
                const acceptCookie = getCookie("cookie_accepted");
                const declineCookie = getCookie("cookie_declined");

                if (!acceptCookie || !declineCookie) {
                    document.body.classList.add("cookies-banner-open");
                }

                if (!acceptCookie) {

                    jQuery(".cookie-block .accept").on("click", (e) => {
                        e.preventDefault();
    
                        setCookie("cookie_accepted", true);
                        location.reload();
                    });
                }

                if (!declineCookie) {

                    jQuery(".cookie-block .decline").on("click", (e) => {
                        e.preventDefault();
    
                        setCookie("cookie_declined", true);
                        location.reload();
                    });
                }

                if((!acceptCookie && declineCookie) || (acceptCookie && !declineCookie)){
                    document.body.classList.remove("cookies-banner-open");
                }
            }
        }


        initSiteCookiesBannerScripts();

        if (getCookie("cookie_accepted")) {
            bookmark();
        }

    });
})();




