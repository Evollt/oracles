require('./layout/basics')
require('./layout/forms')
require('./layout/modals')
require('./layout/select2')

import {initAllDateTimePickers} from "./layout/datetimepicker"
import {initSelect2} from "./layout/select2"

import { initTabs } from './layout/tabs'
initTabs()

import { initModalBindings } from './layout/modals'
initModalBindings()

window.addEventListener('reinitform', () => {
    initAllDateTimePickers()
    initSelect2()
})
