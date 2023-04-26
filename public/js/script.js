


const faders = document.querySelectorAll('.fade-in');

const sliders = document.querySelectorAll('.slide-in');

const appearOptions = {
    threshold: 0,
    rootMargin: "0px 0px -200px 0px"
};

const appearOnScroll = new IntersectionObserver(function(entries, appearOnScroll) {
    entries.forEach(entry => {
        if (!entry.isIntersecting) {
            return;
        } else {
            entry.target.classList.add('appear');
            appearOnScroll.unobserve(entry.target);
        }
    })
}, appearOptions);


faders.forEach(fader => {
    appearOnScroll.observe(fader);
})

sliders.forEach(slider => {
    appearOnScroll.observe(slider);
})




const list = document.querySelectorAll('.list');

function activeLink() {
    list.forEach((item) =>
    item.classList.remove('active'));
    this.classList.add('active');
}

list.forEach((item) =>
    item.addEventListener('click', activeLink));



    let loginForm = document.querySelector('.login-form');

    document.querySelector('#login-btn').onclick = () =>{
        loginForm.classList.toggle('active');
        navbar.classList.remove('active');
    }

    window.onload = () => {
        if(window.scrollY > 0){
            document.querySelector('.header').classList.add('active');
        }else {
            document.querySelector('.header').classList.remove('active');
        }
    } 

    // let cards = document.querySelectorAll('.box')
    
    // function liveSearch() {
    //     let search_query = document.getElementById("searchbox").value;
        
    //     //Use innerText if all contents are visible
    //     //Use textContent for including hidden elements
    //     for (var i = 0; i < cards.length; i++) {
    //         if(cards[i].textContent.toLowerCase()
    //                 .includes(search_query.toLowerCase())) {
    //             cards[i].classList.remove("is-hidden");
    //         } else {
    //             cards[i].classList.add("is-hidden");
    //         }
    //     }
    // }
    
    // //A little delay
    // let typingTimer;               
    // let typeInterval = 500;  
    // let searchInput = document.getElementById('searchbox');
    
    // searchInput.addEventListener('keyup', () => {
    //     clearTimeout(typingTimer);
    //     typingTimer = setTimeout(liveSearch, typeInterval);
    // });


    
    

   