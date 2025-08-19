// ===================== Slideshow =====================
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) { 
    showSlides(slideIndex += n); 
}

function currentSlide(n) { 
    showSlides(slideIndex = n); 
}

function showSlides(n) {
    let slides = document.getElementsByClassName("slides");
    let dots = document.getElementsByClassName("demo");
    let captionText = document.getElementById("caption");
    
    if (n > slides.length) { slideIndex = 1; }
    if (n < 1) { slideIndex = slides.length; }
    
    for (let i = 0; i < slides.length; i++) { slides[i].style.display = "none"; }
    for (let i = 0; i < dots.length; i++) { dots[i].className = dots[i].className.replace(" active",""); }
    
    slides[slideIndex-1].style.display = "block";
    dots[slideIndex-1].className += " active";
    captionText.innerHTML = dots[slideIndex-1].alt;
}

// ===================== Tabs com fade =====================
const tabs = document.querySelectorAll('.TabbedPanelsTab');
const contents = document.querySelectorAll('.TabbedPanelsContent');

// inicializa primeira aba visível
contents.forEach((c,i)=>{
    c.style.opacity = 0;
    c.style.position = 'absolute';
});
contents[0].classList.add('active');
contents[0].style.opacity = 1;
contents[0].style.position = 'relative';
tabs[0].classList.add('ActiveTab');

tabs.forEach((tab,index)=>{
    tab.addEventListener('click', ()=>{
        tabs.forEach(t => t.classList.remove('ActiveTab'));
        contents.forEach(c => c.classList.remove('active'));
        
        tabs[index].classList.add('ActiveTab');
        contents[index].classList.add('active');

        // fade simples
        contents.forEach(c=>{
            c.style.opacity = 0;
            c.style.position = 'absolute';
        });
        contents[index].style.opacity = 1;
        contents[index].style.position = 'relative';
    });
});
