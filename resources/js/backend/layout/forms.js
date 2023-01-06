$(document).on('submit', 'form.ajax', function(e) {
    let container = this.hasAttribute('data-container') ? $(this).closest($(this).data('container')) : $(this)
    let url = $(this).attr('action')
    let data = new FormData(this)

    postAjaxForm(url, data, container)

    // Prevent normal submition
    e.preventDefault()
    return false
})

/**
 * Function that does the actual ajax request
 *
 * @param url
 * @param data
 * @param container
 * @param preventHelperFunctions
 * @return Promise
 */
export const postAjaxForm = (url, data, container, preventHelperFunctions) => {
    if (container) {
        container.startLoading().removeErrors()
    }

    let request = axios.post(url, data, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    });

    return request
        .then(function (response) {
            // Check if returned repsonse has any javascript actions (and we may execute them)
            if (!preventHelperFunctions && typeof response.data.actions !== 'undefined') {
                $.each(response.data.actions, function(index, action) {
                    // When params were given or not
                    if (!action.params) {
                        window.helpers[action.name]()
                    } else {
                        window.helpers[action.name](action.params)
                    }
                })
            }

            return response;
        }).catch(function (error) {
            if (error.response) {
                // The request was made and the server responded with a status code that falls out of the range of 2xx
                if (error.response.status === 422) {
                    if (container) {
                        container.handleErrors(error.response.data.errors)
                    }
                }
            } else if (error.request) {
                console.error(error.request)
            } else {
                console.error('Error', error.message)
            }
        }).then(function (response) {
            if (container) {
                container.stopLoading()
            }

            return response;
        })
}
