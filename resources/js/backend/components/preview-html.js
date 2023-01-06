export const initHidePreviewButton = () => {
    $(document).on('click', '.preview-html', function () {
        $(this).toggleClass('collapsed')
        return false
    })
}

export const hidePreviewHtmlEllipses = () => {
    Array.from(document.querySelectorAll('.preview-html.collapsed'))
        .forEach(element => {
            if (element.offsetWidth >= element.scrollWidth) {
                element.classList.add("text-full-visible");
            } else {
                // Could be reinitialized after ajax request, so make sure to remove if necessary
                element.classList.remove("text-full-visible");
            }
        });
}
