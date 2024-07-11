"use strict"

console.log("loaded JavaScript");

window.addEventListener('load', () => {
    document.getElementById('add-student-form')?.addEventListener('submit', e => {
        const isSubmit = confirm('本当に作成しますか？')
        if (!isSubmit) {
            e.preventDefault()
        }
    })
    document.getElementById('delete-student-form')?.addEventListener('submit', e => {
        const data = new FormData(e.currentTarget)
        const entries = Object.fromEntries(data.entries())
        const isSubmit = confirm(`本当に「${entries["full-name"]}」を削除しますか？`)
        if (!isSubmit) {
            e.preventDefault()
        }
    })
    document.querySelectorAll('.editForm').forEach((form) => {
        form?.addEventListener('submit', e => {
            const isSubmit = confirm('本当に修正しますか？')
            if (!isSubmit) {
                e.preventDefault()
            }
        })
    })
})