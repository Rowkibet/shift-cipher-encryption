const uploadBtn = document.querySelector('#upload-btn');
const overlay = document.getElementById('overlay');
const uploadCloseBtn = document.querySelector('.close-button.upl-btn');
const floatUpload = document.querySelector('.upload-popup');

uploadBtn.addEventListener('click', () => {
    floatUpload.classList.add('active');
    overlay.classList.add('active');
})

uploadCloseBtn.addEventListener('click', () => {
    floatUpload.classList.remove('active');
    overlay.classList.remove('active');
})

overlay.addEventListener('click', () => {
    if(overlay.classList.contains('active')) {
        floatUpload.classList.remove('active');
        overlay.classList.remove('active');
    }
})