// ===============================
// Bootstrap ONLY
// ===============================
import * as bootstrap from 'bootstrap'
window.bootstrap = bootstrap   // ⭐ REQUIRED for global access


// =====================================================
// 🔥 Livewire Modal Listener (BEST PRACTICE)
// =====================================================
document.addEventListener('livewire:init', () => {
    Livewire.on('open-edit-modal', () => {
        const modalEl = document.getElementById('editModal')
        if (!modalEl) return

        const modal = bootstrap.Modal.getOrCreateInstance(modalEl)
        modal.show()
    })
})

console.log('Bootstrap JS Loaded ✔️')
