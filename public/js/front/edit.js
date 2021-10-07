let Mode = document.querySelector(".mode");
let icon = Mode.querySelector("i")

let Storagemode = localStorage.getItem("mode");
Storagemode == null ? changeToDark() : changeToLight();
Mode.addEventListener("click",()=>icon.classList.contains("fa-sun") ? changeToLight() : changeToDark());



function changeToLight()
{
    icon.classList.replace("fa-sun","fa-moon");
    document.body.classList.add("light");
    document.querySelector(".header__content__venor").classList.add("light");
    localStorage.setItem("mode","light");
}
function changeToDark()
{
    icon.classList.replace("fa-moon","fa-sun");
    document.body.classList.remove("light");
    document.querySelector(".header__content__venor").classList.remove("light");
    localStorage.removeItem("mode");
}
/*** Style Switcher  ****/
let styleBox = document.querySelector(".style-box");
let cog = document.querySelector(".style-box .cog");
let colors = styleBox.querySelectorAll(".colors li");
cog.addEventListener("click",()=>{
    styleBox.classList.toggle("active")
})
colors.forEach(color=>
{

    color.style.background = color.dataset.color;
    color.addEventListener("click",()=>{
        document.querySelector(".colors li.active").classList.remove("active")
        color.classList.add("active");
        document.documentElement.style.setProperty('--main-colorz',color.dataset.color);
        localStorage.setItem("color",color.dataset.color);
    })
})
let colorMode = localStorage.getItem("color");
if (colorMode == null ) {
   localStorage.setItem("color","#6164ff");
   document.documentElement.style.setProperty('--main-colorz',localStorage.getItem('color'));
}
else
{
    document.documentElement.style.setProperty('--main-colorz',localStorage.getItem('color'));
}
colors.forEach(color=>{
    if(color.dataset.color == localStorage.getItem('color'))
    {
        color.classList.add("active")
    }
    else
    {
        color.classList.remove("active")
    }

})
