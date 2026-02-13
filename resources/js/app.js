// ===============================
// Bootstrap
// ===============================
import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap

// ===============================
// CoreUI
// ===============================
import * as coreui from '@coreui/coreui'
window.coreui = coreui   // 🔥 VERY IMPORTANT

// ===============================
// Chart.js
// ===============================
import Chart from 'chart.js/auto'
window.Chart = Chart     // 🔥 VERY IMPORTANT

// ===============================
// CoreUI Chart Plugin
// ===============================
import '@coreui/chartjs'

// ===============================
// CoreUI Utils
// ===============================
import '@coreui/utils'

// ===============================
// Simplebar
// ===============================
import SimpleBar from 'simplebar'
window.SimpleBar = SimpleBar

// ===============================
// Your custom JS
// ===============================
import './main'
import './config'
import './color-modes'

document.addEventListener('DOMContentLoaded', () => {
    const btn = document.querySelector('.btn-close')
    const sidebar = document.querySelector('#sidebar')

    if (btn && sidebar) {
        btn.addEventListener('click', () => {
            const instance = coreui.Sidebar.getOrCreateInstance(sidebar)
            instance.toggle()
        })
    }
})


console.log('All JS Loaded Correctly')
