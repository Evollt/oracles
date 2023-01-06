import { closeModal as modalClose, requestModal } from '../layout/modals'
import { closeModals as modalsClose } from '../layout/modals'
import { initSelect2 } from "../layout/select2";

export const isTouch = () => {
    try {
        document.createEvent('TouchEvent')
        return true
    } catch (e) {
        return false
    }
}

export const lockViewport = lock => {
    if (lock) {
        let lastScrollPos = $(window).scrollTop()
        sessionStorage.setItem('lastScrollPos', lastScrollPos)
        $('body').addClass('locked').css('margin-top', '-' + lastScrollPos + 'px')
    } else {
        $('body').removeClass('locked').css('margin-top', '')
        $(window).scrollTop(sessionStorage.getItem('lastScrollPos') || 0)
    }
}

export const initSelect2Helper = () => {
    initSelect2();
}

export const closeLoginOverlay = () => {
    let loginOverlay = $('#loginOverlay')

    if (loginOverlay.length) {
        loginOverlay.find('form')
            .removeClass('animated bounceInUp')
            .addClass('animated bounceOutDown')
        loginOverlay.addClass('animated fadeOut')

        setTimeout(() => {
            loginOverlay.remove()
            window.helpers.lockViewport(false)
        }, 1000)
    }
}

export const reloadPage = () => {
    location.reload()
}

export const redirectPage = params => {
    window.location.replace(params.url)
}

export const alertErrors = (errors) => {
    if (typeof errors != undefined && errors) {
        let showErrors = []
        $.each(errors, function(key, value) {
            showErrors.push(value)
        })
        if (showErrors.length) {
            alert(showErrors.join(', '))
        }
    }
}

export const dispatchEvent = params => {
    window.dispatchEvent(new CustomEvent(params.name))
}

export const replaceContent = function(params) {
    let target = $(params.target)
    if (target.length) {
        target.replaceWith(params.content)
    }
}

export const removeContent = function(params) {
    let target = $(params.target)
    if (target.length) {
        target.remove()
    }
}

export const appendContent = function(params) {
    let target = $(params.target)
    if (target.length) {
        target.append(params.content)
    }
}

export const replaceCsrf = function(params) {
    let target = $('input[type="hidden"][name="_token"]')

    if (target.length) {
        console.log('Do it')
        target.val(params.token)
    }
}

export const copyToClipboard = (str, elem) => {
    window.navigator.clipboard.writeText(str).then(() => {
        elem.classList.add('animate__animated', 'animate__zoomIn')
    })

    elem.classList.add('animate__animated', 'animate__zoomIn')

    //Remove the classes so we can show again after a second
    window.setTimeout(() => {
        elem.classList.remove('animate__animated', 'animate__zoomIn')
    }, 1000);
}

export const openModal = (url, post = false, data = null) => {
    requestModal(url, post, data)
}

export const closeModal = () => {
    modalClose()
}

export const closeModals = () => {
    modalsClose()
}

export const displayPrice = (amountInCents) => {
    return '&euro; ' + (amountInCents / 100).toFixed(2).replace('.', ',');
}
