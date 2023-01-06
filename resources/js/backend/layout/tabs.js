export const initTabs = () => {
    let tabContainers = $('.tabs:not(.initialized)')

    if (tabContainers.length) {
        tabContainers.each((index, tabContainer) => {
            initTabContainer($(tabContainer))
        })
    }
}

const initTabContainer = tabContainer => {
    let tabs = tabContainer.find('.tabs__nav li[data-tab]')

    selectTab(tabs.first())

    tabs.on('click', function() {
        selectTab($(this))
    })

    // Activate first tab
    tabs.first().addClass('selected').trigger('click')

    // Make sure this tabContainer is initialized
    tabContainer.addClass('initialized')
}

const selectTab = tab => {
    if (tab.hasClass('selected')) {
        return
    }

    let containers = tab.closest('.tabs').find('.tabs__content div[data-tab]')

    tab.addClass('selected').siblings().removeClass('selected')
    containers.filter('[data-tab="' + tab.data('tab') + '"]').show().siblings().hide();
}
