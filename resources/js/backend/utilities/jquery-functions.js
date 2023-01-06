/**
 * Add loading class to element
 * @returns {$}
 */
$.fn.startLoading = function() {
    this.addClass('loading')

    return this
}

/**
 * Remove loading class from element
 * @returns {$}
 */
$.fn.stopLoading = function() {
    this.removeClass('loading')

    return this
}

/**
 * Focus on first element with the autofocus attribute
 * @returns {$}
 */
$.fn.focusInput = function() {
    $(this).find('[autofocus]').first().focus()

    return this
}

/**
 * Show errors within element
 * @param errors
 * @returns {$}
 */
$.fn.handleErrors = function(errors = null) {
    let extraErrors = []
    let container = this
    if (typeof errors != undefined && errors) {
        $.each(errors, function(key, value) {

            let input = container.find('[name="' + key + '"]')

            if(input.length === 0 && key.indexOf('.') !== -1) {
                // Convert error key array to HTML names
                let parts = key.split('.');
                let inputIndex = parseInt(parts.pop());
                let newKey = parts.shift();

                for (let i = 0; i < parts.length; i++) {
                    newKey += '[' + parts[i] + ']';
                }

                if (!Number.isNaN(inputIndex)) {
                    // When it's a number, its probably an index
                    input = container.find('[name^="' + newKey + '"]:not(:disabled):eq('+ inputIndex +')');
                } else {
                    // It's not an index, then just add to the full key with [] and search
                    newKey += '[' + inputIndex + ']';
                    input = container.find('[name="' + newKey + '"]');
                }
            }

            if (input.length) {
                input.addClass('border-red-400 border-2').after('<p class="text-red-400 font-bold mt-2 text-xs">' + value + '</p>')
            } else {
                extraErrors.push(value)
            }
        })
        if (extraErrors.length) {
            this.prepend('<p class="text-red-400 font-bold mb-4 text-xs">' + extraErrors.join('<br>') + '</p>')
        }
    } else {
        this.prepend('<p class="text-red-400 font-bold mb-4 text-xs">Er ging iets fout tijdens het uitvoeren van deze actie.</p>')
    }

    return this
}

/**
 * Remove errors from form
 * @returns {$}
 */
$.fn.removeErrors = function() {
    this.find('[name] + p.text-red-400').remove()
    this.find('input.border-red-400.border-2').removeClass('border-red-400 border-2')

    return this
}

/**
 * Scroll to an element within an elemen
 * @param  string elem
 * @return jQuery element
 */
 $.fn.scrollTo = function(elem) {
    let scrolltoElement = this.find(elem).first()

    if (scrolltoElement.length) {
        this.scrollTop((this.scrollTop() + scrolltoElement.offset().top) - 100)
    }

    return this
};

