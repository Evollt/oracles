/**
 * Let op: als je in dit bestand werkt!
 * Het bestand wordt zowel in app.js als in ckeditor.js gebruikt
 * ckeditor.js wordt als laatste ingeladen in de browser waardoor deze overruled wat in app.js staat
 * Als je dus npm run watch gebruikt worden je wijzigingen meteen overruled door ckeditor.js
 * TODO Bovenstaand oplossen ;)
 */

$.fn.select2.defaults.set('theme', 'lara');
$.fn.select2.defaults.set('width', '100%');

$(document).on("select2:open", () => {
    document.querySelector(".select2-container--open .select2-search__field").focus()
});

function formatOption (option) {
    if (!option.id) {
        return option.text;
    }

    if (
        typeof $(option.element).data('image') === 'undefined' &&
        typeof $(option.element).data('color') === 'undefined' &&
        typeof $(option.element).data('nestedset-depth') === 'undefined' &&
        typeof option.image === 'undefined' &&
        typeof option.color === 'undefined' &&
        typeof option.nestedsetDepth === 'undefined'
    ) {
        // If it's undefined than the option has no image to show.
        return option.text;
    }

    if (typeof $(option.element).data('image') !== 'undefined' || typeof option.image !== 'undefined') {
        let image;
        if(typeof $(option.element).data('image') !== 'undefined' ) {
            image = $(option.element).data('image');
        } else {
            image = option.image;
        }

        if (image.length === 0) {
            // Normally it would show an image but this resource has no image attached. Show some white space for alignement
            return $('<span class="select2-option-no-img">' + option.text + '</span>');
        }

        return $('<span class="select2-option-img"><img src="' + image + '" /> ' + option.text + '</span>');
    }

    if (typeof $(option.element).data('color') !== 'undefined' || typeof option.color !== 'undefined') {
        let color;
        if(typeof $(option.element).data('color') !== 'undefined' ) {
            color = $(option.element).data('color');
        } else {
            color = option.color;
        }

        if (color.length === 0) {
            // Normally it would show an color but this resource has no color attached. Show some white space for alignement
            return $('<span class="select2-option-no-color">' + option.text + '</span>');
        }

        return $(
            '<span class="select2-option-color flow-root">' +
                '<span class="inline-block h-4 w-4">' +
                    '<span class="block rounded-full shadow h-4 w-4 relative" style="top: 2px; '+ color +'"></span>' +
                '</span>' +
                option.text +
            '</span>');
    }

    if (typeof $(option.element).data('nestedset-depth') !== 'undefined' || typeof option.nestedsetDepth !== 'undefined') {
        let depth = 0;
        let path = '';
        if(typeof $(option.element).data('nestedset-depth') !== 'undefined' ) {
            depth = parseInt($(option.element).data('nestedset-depth'));
            path = $(option.element).data('nestedset-path');
        } else {
            depth = parseInt(option.nestedsetDepth);
            path = option.nestedsetPath;
        }

        if (depth > 0) {
            let html = '';
            for(var i = 0; i < depth; i++) {
                html += '<span class="handle" style="left: '+ ((depth-1) * 25) +'px;"></span>';
            }

            html += '<span class="nestedset-path">' + path + ' / </span>';

            return $('<span class="nestedset-option-container" style="padding-left: '+ (depth * 25) +'px;">' + html + option.text + '</span>');
        }

        return option.text;
    }
}

export const initSelect2 = () => {
    $('.select2').each(function () {
        let element = $(this);
        let options = {
            templateResult: formatOption,
            templateSelection: formatOption,
            placeholder: "- select -",
            allowClear: true
        };

        if (typeof element.data('ajax--url') !== 'undefined') {
            if (typeof options.ajax === 'undefined') {
                options.ajax = {};
            }

            options.ajax.processResults = function (data) {
                let values = [];
                $.each(data.data, function (key, item) {
                    values.push({
                        id: item.value,
                        text: item.label,
                        image: item.image,
                        color: item.color,
                        stock: item.stock,
                        inStock: item.inStock,
                    });
                });

                return {
                    results: values,
                    pagination: {
                        more: (data.current_page * 25) < data.total
                    }
                };
            };
        }

        $(this).select2(options);

        $(this).on('select2:closing', function (e) {
            // When select2 is closed remove all select2 search classes to go back to initial state
            $('.select2-searching').removeClass('select2-searching');
        });
    });
}

$(document).on('keyup', '.select2-search__field', function () {
    let container = $('.select2-container--open');
    if ($(this).val().length > 0) {
        container.addClass('select2-searching');
    } else {
        container.removeClass('select2-searching');
    }
});

initSelect2();
