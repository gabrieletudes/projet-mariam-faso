var responsiveButton = document.getElementById('js-header-icon');
var responsiveNav = document.getElementById('js-responsive-nav');
var responsiveNavBreakpoint = 599;

responsiveButton.addEventListener('click', function(e){
    e.preventDefault();
    if(window.innerWidth < responsiveNavBreakpoint){
        responsiveNav.classList.toggle("with--sidebar");
    }
});
