  /*====== Sticky Navbar =====*/

window.onscroll = () => {

    let header = document.querySelector('.header');

    header.classList.toggle('sticky', window.scrollY > 100);

};

// scroll reveal

ScrollReveal ({
    // reset : true, 
    distance : '80px',
    duration : 2000,
    delay: 200
});

ScrollReveal().reveal('.home-content, .heading', { origin: 'top' });
ScrollReveal().reveal('.home-img img, .berita-container, .galeri-box', { origin: 'bottom' });
ScrollReveal().reveal('.home-content h1, .about-img img', { origin: 'left' });
ScrollReveal().reveal('.home-content h3, .home-content p, .about-content', { origin: 'right' });


// countdown

var target_mili_sec = new Date("Feb 14, 2024 09:00:0").getTime();
function timer(){
    var now_mili_sec = new Date().getTime();
    var remaining_sec = Math.floor ( (target_mili_sec - now_mili_sec)/1000);

    var day = Math.floor(remaining_sec / (3600 * 24));
    var hour = Math.floor (remaining_sec % (3600 * 24) / 3600); 
    var min = Math.floor (remaining_sec % 3600 / 60);
    var sec = Math.floor (remaining_sec % 60);

    document.querySelector("#day").innerHTML = day ;
    document.querySelector("#hour").innerHTML = hour ;
    document.querySelector("#minute").innerHTML = min ;
    document.querySelector("#second").innerHTML = sec ;
}

setInterval(timer, 1000);
