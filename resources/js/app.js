require('./bootstrap')

import { createApp } from 'vue'
import App from './components/app'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faPlus, faTrash } from '@fortawesome/free-solid-svg-icons'

library.add(faPlus, faTrash)

const app = createApp({})

app.component('font-awesome-icon', FontAwesomeIcon)
app.component('app', App)

app.mount('#app')
