"use strict"

console.log("loaded JavaScript");

window.addEventListener('load', () => {
    document.getElementById('add-student-form').addEventListener('submit', e => {
        const isSubmit = confirm('本当に作成しますか？')
        if (!isSubmit) {
            e.preventDefault()
        }
    })
})