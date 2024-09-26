/* -- event handlers -- */
window.onscroll = function () {
    updateHeader()
}

window.onresize = function () {
    updateHeader()
}

/* -- header functions -- */
function updateHeader() {
    var screenWidth = window.innerWidth
    var scrollTop = window.scrollY
    var mainHeader = document.querySelector(".main-header")

    if (screenWidth >= 900) {
        if (scrollTop <= 40) {
            mainHeader.style.padding = "2rem 5rem"
        } else {
            mainHeader.style.padding = "1rem 5rem"
        }
    } else {
        if (scrollTop <= 40) {
            mainHeader.style.padding = "2rem 1.5rem"
        } else {
            mainHeader.style.padding = "1rem 1.5rem"
        }
    }
}
