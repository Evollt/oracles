export const initDateTimePickers = () => {
    let dateTimePickers = $('.date-time-picker:not(.initialized)')

    if (dateTimePickers.length) {
        dateTimePickers.each((index, dateTimePicker) => {
            flatpickr(dateTimePicker, {
                enableTime: true,
                dateFormat: "d-m-Y H:i",
                time_24hr: true,
                onReady: function ( dateObj, dateStr, instance ) {
                    const $clear = $( '<div class="flatpickr-clear float-left px-2 mb-2 ml-2 border rounded border-red-400"><button class="flatpickr-clear-button ">Clear</button></div>' )
                        .on( 'click', () => {
                            instance.clear();
                            instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );

                    const $done = $( '<div class="flatpickr-done float-right px-2 mb-2 mr-2 border rounded border-green-400"><button class="flatpickr-done-button ">Done</button></div>' )
                        .on( 'click', () => {
                            instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );
                }
            });

            $(dateTimePicker).addClass('initialized');
        })
    }
}

export const initDatePickers = () => {
    let datePickers = $('.date-picker:not(.initialized)')

    if (datePickers.length) {
        datePickers.each((index, datePicker) => {
            flatpickr(datePicker, {
                dateFormat: "d-m-Y",
                onReady: function ( dateObj, dateStr, instance ) {
                    const $clear = $( '<div class="flatpickr-clear float-left px-2 mb-2 ml-2 border rounded border-red-400"><button class="flatpickr-clear-button ">Clear</button></div>' )
                        .on( 'click', () => {
                            instance.clear();
                            instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );

                    const $done = $( '<div class="flatpickr-done float-right px-2 mb-2 mr-2 border rounded border-green-400"><button class="flatpickr-done-button ">Done</button></div>' )
                        .on( 'click', () => {
                            instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );
                }
            });

            $(datePicker).addClass('initialized');
        })
    }
}

export const initTimePickers = () => {
    let timePickers = $('.time-picker:not(.initialized)')

    if (timePickers.length) {
        timePickers.each((index, timePicker) => {
            flatpickr(timePicker, {
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                onReady: function ( dateObj, dateStr, instance ) {
                    const $clear = $( '<div class="flatpickr-clear float-left px-2 mb-2 ml-2 border rounded border-red-400"><button class="flatpickr-clear-button ">Clear</button></div>' )
                        .on( 'click', () => {
                            instance.clear();
                            instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );

                    const $done = $( '<div class="flatpickr-done float-right px-2 mb-2 mr-2 border rounded border-green-400"><button class="flatpickr-done-button ">Done</button></div>' )
                        .on( 'click', () => {
                            instance.close();
                        } )
                        .appendTo( $( instance.calendarContainer ) );
                }
            });

            $(timePicker).addClass('initialized');
        })
    }
}

export const initAllDateTimePickers = () => {
    initDatePickers();
    initDateTimePickers();
    initTimePickers();
}

initAllDateTimePickers();
