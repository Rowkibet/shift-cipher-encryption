const encryptBtn = document.querySelector('#encrypt-btn');
const decryptBtn = document.querySelector('#decrypt-btn');
const overlay = document.getElementById('overlay');
const encryptCloseBtn = document.querySelector('.close-button.enc-btn');
const decryptCloseBtn = document.querySelector('.close-button.dec-btn');
const floatEncrypt = document.querySelector('.float-encrypt');
const floatDecrypt = document.querySelector('.float-decrypt');

encryptBtn.addEventListener('click', () => {
    floatEncrypt.classList.add('active');
    overlay.classList.add('active');
})

encryptCloseBtn.addEventListener('click', () => {
    floatEncrypt.classList.remove('active');
    overlay.classList.remove('active');
})

decryptBtn.addEventListener('click', () => {
    floatDecrypt.classList.add('active');
    overlay.classList.add('active');
})

decryptCloseBtn.addEventListener('click', () => {
    floatDecrypt.classList.remove('active');
    overlay.classList.remove('active');
})

overlay.addEventListener('click', () => {
    if(overlay.classList.contains('active')) {
        if(floatEncrypt.classList.contains('active')) {
            floatEncrypt.classList.remove('active');
            overlay.classList.remove('active');
        } else {
            floatDecrypt.classList.remove('active');
            overlay.classList.remove('active');
        }
    }
})