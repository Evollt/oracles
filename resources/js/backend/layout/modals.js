import {initSelect2} from "./select2";
import {initAllDateTimePickers} from "./datetimepicker";
import {hidePreviewHtmlEllipses} from "../components/preview-html";

export const initModalBindings = () => {
    $(document).on('click', 'a.open-modal[href], *[data-modal]', function (e) {
        openModal($(this))
        e.preventDefault()
    })

    $(document).on('click', '.close-modal', function () {
        closeModal()
    })

    $(document).on('keydown', function (e) {
        if (e.keyCode === 27) {
            closeModal()
        }
    })

    $(document).ready( function () {
        // Init elements on page load if modal is in html
        if ($('.modal').length > 0) {
            initModalHtmlElements()
        }
    })
}

const openModal = elem => {
    let url, post = false, data = null

    // Determine how to get url
    if(elem.is('a')) {
        url = elem.attr('href')
    } else {
        url = elem.data('modal')
    }

    if (typeof url == 'undefined' || !url) {
        alert(`Geen url om modal voor te openen`)
        return
    }

    if (elem.data('post')) {
        post = true
        data = elem.data('post')
    }

    // if body hasClass loading-modal
    if(!$('body').hasClass('loading-modal')){
        requestModal(url, post, data, elem)
    }
}

export const initModalHtmlElements = () => {
    // $(".modal").modal()
    $('.modal').first().modal('show');
    // initSelect2();
    // initAllDateTimePickers();
    // hidePreviewHtmlEllipses();
}

export const requestModal = (url, post, data, elem) => {
    let request
    $('body').startLoading()
    $('body').addClass('loading-modal')
    elem.addClass('loading')

    if (post) {
        request = axios.post(url, data)
    } else {
        request = axios.get(url)
    }

    return request.then(function (response) {
        if (typeof response.data == 'undefined' || response.data == '') {
            alert(`Modal bevat geen html`)
            return
        }

        // Append modal html to body
        window.helpers.lockViewport(true)
        let modal = $(response.data)
        $('.modal').remove()
        modal.appendTo('body')

        initModalHtmlElements();
    }).catch(function (error) {
        if (error.response) {
            window.helpers.alertErrors(error.response.data.errors)
        } else if (error.request) {
            console.error(error.request)
        } else {
            console.error('Error', error.message)
        }
    }).then(function () {
        $('body').stopLoading()
        $('body').removeClass('loading-modal')
        elem.removeClass('loading')
    })
}

export const closeModal = () => {
    $('.modal').remove()

    window.helpers.lockViewport(false)
}

export const closeModals = () => {
    let modals = $('body > .modal')

    if (modals.length > 0) {
        modals.remove()
        window.helpers.lockViewport(false)
    }
}
