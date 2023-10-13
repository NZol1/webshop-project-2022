//Az alap telefonos navmenu
function mobilenavlinks(menu)
{
    if (!menu.classList.contains('open'))
    {
        menu.classList.toggle('open');
        document.body.style.overflowY = "hidden";

    } else if (menu.classList.contains('open'))
    {
        menu.classList.toggle('open')
        document.body.style.overflowY = "visible";
    }

}

//A kis logó-ra kattintva előjövő menü
function shoppingcartinfo()
{
    const shoppingcart = document.getElementById('shopping-cart-content');
    if (!shoppingcart.classList.contains('clicked'))
    {
        shoppingcart.classList.toggle('clicked');
    } else if (shoppingcart.classList.contains('clicked'))
    {
        shoppingcart.classList.toggle('clicked')
    }
}


//Jelszót mutató
const showPass = document.getElementById('password-type');
const showPass2 = document.getElementById('password-type2');

const buttonPass = document.getElementById("eye");
const buttonPass2 = document.getElementById("eye2");
function showpassword()
{
    if (showPass.type == 'password')
    {
        showPass.type = 'text';
        buttonPass.classList.remove('fa-eye-slash');
        buttonPass.classList.add('fa-eye');
    } else if (showPass.type == 'text')
    {
        showPass.type = 'password';
        buttonPass.classList.remove('fa-eye');
        buttonPass.classList.add('fa-eye-slash');
    }

}

function showpassword2()
{
    if (showPass2.type == 'password')
    {
        showPass2.type = 'text';
        buttonPass2.classList.remove('fa-eye-slash');
        buttonPass2.classList.add('fa-eye');
    } else if (showPass2.type == 'text')
    {
        showPass2.type = 'password';
        buttonPass2.classList.remove('fa-eye');
        buttonPass2.classList.add('fa-eye-slash');
    }

}

//Filtereket előhozó stage
const filterek = document.getElementsByClassName('filters')[0];
function showFilters(){
    if(!filterek.classList.contains('fopen'))
    {
        filterek.classList.add('fopen');
        document.getElementsByClassName('filter-show')[0].value = "Elrejtés"
    } else if(filterek.classList.contains('fopen'))
    {
        filterek.classList.remove('fopen');
        document.getElementsByClassName('filter-show')[0].value = 'Megjelenítés'
    }
}

//OWL Körhinta a termékek megjelenítésére!
var owl = $('.owl-carousel')
// Listen to owl events:
owl.on('changed.owl.carousel', function(event) {

})
$(owl).owlCarousel({
    loop:true,
    margin:5,
    responsiveClass:true,
    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"],
    URLhashListener: true,
    startPosition: 'URLHash',
    responsive:{

        0:{
            items:2,
            margin: 23,
            dots:false,
            nav:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            autoHeight:true
        },
        786:{
            items:3,
            margin:23,
            dots:false,
            nav:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            autoHeight:true
        },
        992:{
            items:4,
            margin:23,
            dots:false,
            nav:true,
            autoplay:true,
            autoplayTimeout:5000,
            autoplayHoverPause:true,
            autoHeight:true
        },

    }
})


function ScrollTop(){
    window.scroll({top:0, left:0});
}

