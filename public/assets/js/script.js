// ----------Securisation de mon form a l aide d un RegExp------------------

//Je verfie les charactere entree dans le champ input
$("#search-bar").keyup(function(){
    //J'assigne à ma variable value la valeur de mon input
    var value = $( this ).val();
    //Je créé une variable qui contient mon RegExp
    var characterReg = /^[a-zA-Z\d\-_.,\s]+$/;
    //je créé une condition qui compart la valeur de mon champ avec  le RegExp.
    //Cela me renvoie un message d'alert si les valeurs de l'input contiennent des caractères spéciaux.
    if (!characterReg.test(value)) {
        alert("Caractères spéciaux interdits");
        return false;
    }
});

//-----------------Scroll return Up JQuery----------------
$(document).ready(function(){

    $('#back-to-top').click(function(){

        $('html').animate({

            scrollTop:0

        }, 'slow');

    });
});

$(document).ready(function() {

    $(window).scroll(function(){

        if ($(window).scrollTop() >= 300) {

            document.querySelector('#back-to-top').classList.add('visible');

        } else {

            document.querySelector('#back-to-top').classList.remove('visible');
        }
    });
});

//--------------------SearchBar-------------------------
const input = document.getElementById("search-input");
const searchBtn = document.getElementById("search-btn");

const expand = () => {
    searchBtn.classList.toggle("close");
    input.classList.toggle("square");
};

searchBtn.addEventListener("click", expand);