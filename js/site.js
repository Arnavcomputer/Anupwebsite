document.addEventListener('DOMContentLoaded',()=>{
 const nav=document.getElementById('mainNav');
 const toggle=document.querySelector('.nav-toggle');
 const links=document.querySelector('.nav-links');
 if(toggle&&links){toggle.addEventListener('click',()=>links.classList.toggle('show'));}
 document.querySelectorAll('.dropdown > a').forEach(a=>a.addEventListener('click',e=>{if(window.innerWidth<=950){e.preventDefault();a.parentElement.classList.toggle('open');}}));
 document.querySelectorAll('.section-head, .event-card, .news-card, .facility-card, .stats > div, .gallery-grid figure, .doc-card, .resource-row, .about-hero-card, .message-preview, .cbse-link, .tc-public-option, .tc-public-note, .single-message img, .big-message img, .split > div, .split > img, .form').forEach(el => el.classList.add('reveal'));
 document.querySelectorAll('.reveal').forEach(el=>{const io=new IntersectionObserver(es=>es.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');io.unobserve(e.target)}}),{threshold:.12});io.observe(el)});
 if(nav){
   const placeholder=document.createElement('div'); placeholder.className='nav-placeholder'; nav.parentNode.insertBefore(placeholder,nav.nextSibling);
   let navTop=nav.getBoundingClientRect().top+window.scrollY;
   const fix=()=>{if(window.scrollY>navTop){const h=nav.offsetHeight;placeholder.style.height=h+'px';nav.classList.add('nav-fixed-active');document.body.classList.add('nav-fixed-mode');}else{placeholder.style.height='0px';nav.classList.remove('nav-fixed-active');document.body.classList.remove('nav-fixed-mode');}};
   const recalc=()=>{if(!nav.classList.contains('nav-fixed-active')) navTop=nav.getBoundingClientRect().top+window.scrollY;fix();};
   window.addEventListener('scroll',fix,{passive:true});window.addEventListener('resize',recalc);recalc();
 }
});