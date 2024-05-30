window.addEventListener('scroll', function() {
    var navbar = document.getElementById('navbar');
    if (window.scrollY > 50) { // Adjust the scroll threshold as needed
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});



window.addEventListener('DOMContentLoaded', function() {
    var heartIcon = document.getElementByClassName('fa-heart');
    heartIcon.addEventListener('click', function(event) {
        event.preventDefault(); 
        this.classList.toggle('favorite'); 
    });
});


function goTo() {
    window.location.href = "shop.php";
}

