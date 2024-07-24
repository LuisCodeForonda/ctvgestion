var toogle_menu = document.querySelector('.toogle_menu');
var items = document.querySelectorAll('.list-button')

toogle_menu.addEventListener('click', ()=>{
    document.querySelector('.box-1').classList.toggle('box')
})

items.forEach((item) => {
    item.addEventListener('click', () => {
        item.classList.toggle("arrow");
        var submenu = item.nextElementSibling;
        var height = 0;
        if(submenu.clientHeight == "0"){
            height = submenu.scrollHeight;
        }
        submenu.style.height = `${height}px`;
    });
})