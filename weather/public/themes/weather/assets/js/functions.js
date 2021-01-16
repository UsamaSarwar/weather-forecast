$(document).ready(function() {
    // Menu Collapse
    $(document).on('click', '.menu-button', function() {
        var menuId = $(this).data('db-id');

        // Remove all active button states
        $('.menu-button:not(#db-'+menuId+')').removeClass('menu-button-collapsed icon-active');

        // Remove all active drop-down states
        $('.menu').removeClass('menu-collapsed');

        // If the drop-down has already already opened
        if($('#db-'+menuId).hasClass('menu-button-collapsed')) {
            // Close the drop-down
            $('#db-'+menuId).removeClass('menu-button-collapsed icon-active');
            return;
        }

        // Add the drop-down active class
        $('#db-'+menuId).toggleClass('menu-button-collapsed icon-active');


        // Show the drop-down
        $('#dd-'+menuId).toggleClass('menu-collapsed');
    });

    $(document).on('click', '.notification-close-error, .notification-close-warning, .notification-close-success, .notification-close-info', function() {
        $(this).parent().fadeOut("slow");
        return false;
    });

    // Focus the search box
    if($('#search-input').data('autofocus') == 1) {
        $('#search-input').focus();
    }

    // Clear search box
    $(document).on('click', '#clear-button', function() {
        $('#search-input').val('');
        $('#search-input').focus();
    });

    // Search box submit
    $(document).on('keypress', '#search-input', function(e) {
        if(e.which === 13) {
            $('#search-button').click();
        }
    });

    // Search button submit
    $(document).on('click', '#search-button', function() {
        var searchInput = $('#search-input');

        // If the search input is not empty
        if(searchInput.val().length > 0) {
            search();
        }
    });

    // Popup, Modals, Menus hide actions
    $(document).on('mouseup', function(e) {
        // All the divs that needs to be excepted when being clicked (including the divs themselves)
        var container = $('.menu-button, .menu-content, .fav-list, .search-list, #search-input, #search-button');

        // If the element clicked isn't the container nor a descendant then hide elements
        if(!container.is(e.target) && container.has(e.target).length === 0) {
            // Close menu
            if($('.menu-button').hasClass('menu-button-collapsed')) {
                $('.menu-button').click();
            }
            // Close favorite list
            closeFavorites();

            // Close search list
            closeSearchResults();
        }
    });

    // Show the search results / favorites list
    $(document).on('focus keyup', '#search-input', function(e) {
        var code = (e.keyCode || e.which);

        // If arrow keys are pressed
        if(code == 37 || code == 38 || code == 39 || code == 40) {
            return;
        }

        // If the user typed in the search box
        if($('#search-input').val().length > 0) {
            closeFavorites();
            search();
            $('.search-list').show();
        } else {
            closeSearchResults();
            // Check if there's at least one item in the list
            if($('.fav-list-item').length) {
                $('.fav-list').show();
            }
        }
    });

    setRefreshPage();
});

$(document).on("click", "a:not([data-nd])", function() {
    var linkUrl = $(this).attr('href');
    loadPage(linkUrl, 0, null);
    return false;
});

$(window).bind('popstate', function() {
    var linkUrl = location.href;
    loadPage(linkUrl, 0, null);
});

function search() {
    var searchInput = $('#search-input');
    loadPage(searchInput.data('search-url'), 1, {location: searchInput.val(), token_id: searchInput.data('token-id')}, {loadingBar: false});
}

function setRefreshPage() {
    refreshing = setInterval(refreshPage, 600000);
}

function refreshPage() {
    var currentUrl = location.href;

    // If the page is a dedicated weather location
    if(currentUrl.indexOf('location/') > -1) {
        loadPage(currentUrl, 0, null);
    }
}

/**
 * Send a GET or POST request dynamically
 *
 * @param   argUrl      Contains the page URL
 * @param   argParams   String or serialized params to be passed to the request
 * @param   argType     Decides the type of the request: 1 for POST; 0 for GET;
 * @param   options     Various misc options
 * @return  string
 */
function loadPage(argUrl, argType, argParams, options = {loadingBar: true}) {
    if(options.loadingBar) {
        loadingBar(1);
    }

    if(argType == 1) {
        argType = "POST";
    } else {
        argType = "GET";

        // Store the url to the last page accessed
        if(argUrl != window.location) {
            window.history.pushState({path: argUrl}, '', argUrl);
        }
    }

    // Request the page
    $.ajax({
        url: argUrl,
        type: argType,
        data: argParams,
        success: function(data) {
            // Parse the output
            try {
                var result = jQuery.parseJSON(data);

                $.each(result, function(item, value) {
                    if(item == "title") {
                        document.title = value;
                    } else if(['header', 'content', 'footer'].indexOf(item) > -1) {
                        $('#'+item).replaceWith(value);
                    } else {
                        $('#'+item).html(value);
                    }
                });
            } catch(e) {

            }

            // Scroll the document at the top of the page
            $(document).scrollTop(0);

            // Reload functions
            reload();

            if(options.loadingBar) {
                loadingBar(0);
            }
        }
    })
}

/**
 * The loading bar animation
 *
 * @param   type    The type of animation, 1 for start, 0 for stop
 */
function loadingBar(type) {
    if(type) {
        $("#loading-bar").show();
        $("#loading-bar").width((50 + Math.random() * 30) + "%");
    } else {
        $("#loading-bar").width("100%").delay(50).fadeOut(400, function() {
            $(this).width("0");
        });
    }
}

/**
 * This function gets called every time a dynamic request is made
 */
function reload() {
    // Reset the refreshing state
    clearInterval(refreshing);
    setRefreshPage();
}

/**
 * Get the value of a given cookie
 *
 * @param   name
 * @returns {*}
 */
function getCookie(name) {
    var name = name + '=';
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');

    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while(c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if(c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}

/**
 * Set a cookie
 *
 * @param   name
 * @param   value
 * @param   expire
 * @param   path
 */
function setCookie(name, value, expire, path) {
    document.cookie = name + "=" + value + ";expires=" + (new Date(expire * 1000).toUTCString()) + ";path=" + path;
}

/**
 * Send the AJAX POST request for a given form
 *
 * @param   id  The form ID
 */
function post(id) {
    loadPage(window.location.href, 1, $('form#'+id).serialize());
    return;
}

/**
 * Add or remove an item from the Favorites list
 *
 * @param   id
 */
function setFavorite(id) {
    var list = JSON.parse(getCookie('favorites'));

    var found = false;

    $.each(list['items'], function(locId) {
        // If the location already exists, then remove it
        if(id == locId) {
            found = true;
        }
    });

    // If the location is not favorite
    if(found === false) {
        // Add the location to favorites
        list['items'][id] = name;
    } else {
        // Remove the location from favorites
        $('.button-round-container').removeClass('button-round-active');
        $('.fav-list-item[data-favorite-item="'+id+'"]').remove();
        delete list['items'][id];
    }

    // Update the cookie
    setCookie('favorites', JSON.stringify(list), list['expire'], list['path']);
}

/**
 * Closes the Favorites list
 */
function closeFavorites() {
    $('.fav-list').hide();
}

/**
 * Closes the Search Results list
 */
function closeSearchResults() {
    $('.search-list').hide();
}

/**
 * Calculate the distance between two geographic coordinates
 *
 * @param lat1
 * @param lon1
 * @param lat2
 * @param lon2
 * @param unit
 * @returns {number}
 */
function distanceAB(lat1, lon1, lat2, lon2, unit) {
    var radLat1 = Math.PI * lat1/180;
    var radLat2 = Math.PI * lat2/180;
    var theta = lon1-lon2;
    var radTheta = Math.PI * theta/180;
    var dist = Math.sin(radLat1) * Math.sin(radLat2) + Math.cos(radLat1) * Math.cos(radLat2) * Math.cos(radTheta);
    if(dist > 1) {
        dist = 1;
    }
    dist = Math.acos(dist);
    dist = dist * 180 / Math.PI;
    dist = dist * 60 * 1.1515;
    dist * 1.609344
    if (unit=="KM") { dist = dist * 1.609344 }
    if (unit=="NM") { dist = dist * 0.8684 }
    return dist
}

/**
 * Get the user's geographic coordinates
 *
 * @param cookie_path
 */
function userLocation(cookie_path) {
    if(!navigator.geolocation){
        return;
    }

    function success(position) {
        var latitude  = position.coords.latitude;
        var longitude = position.coords.longitude;

        old_lat = getCookie('lat');
        old_lon = getCookie('lon');

        setCookie('lat', latitude, 1838648626, cookie_path);
        setCookie('lon', longitude, 1838648626, cookie_path);

        var distance = distanceAB(old_lat, old_lon, latitude, longitude, 'KM');

        if(old_lat == 0 || old_lon == 0) {
            loadPage(location.href, 0, null);
        }

        // If the distance between the last remembered location is bigger than 5 km, reload
        if(distance > 5) {
            loadPage(location.href, 0, null);
        }
    }

    function error() {
        old_lat = getCookie('lat');
        old_lon = getCookie('lon');

        setCookie('lat', 0, 1838648626, cookie_path);
        setCookie('lon', 0, 1838648626, cookie_path);

        if(old_lat != 0 || old_lon != 0) {
            loadPage(location.href, 0, null);
        }
    }

    navigator.geolocation.getCurrentPosition(success, error);
}