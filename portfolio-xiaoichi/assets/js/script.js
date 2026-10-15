// Data
const experiences = [
  {co:'Xiaoming Group',per:'2021 - Present',role:'Founder',loc:'Surabaya, Indonesia',desc:'Leading cross-disciplinary teams and managing digital content production. (Edit detail di script.js)',ach:[],tech:['Leadership','Management']},
  {co:'Ni Xiang Tour & Travel',per:'2023 - 2025',role:'Multilingual Translator',loc:'Indonesia',desc:'Bridging global communications in Mandarin & English. (Edit detail di script.js)',ach:[],tech:['Mandarin','English','Translation']},
  {co:'Freelance',per:'2025 - Present',role:'Junior Developer',loc:'Surabaya, Indonesia',desc:'Developing custom digital products. (Edit detail di script.js)',ach:[],tech:['HTML','CSS','JavaScript','PHP']},
  {co:'Musician',per:'2019 - Present',role:'Violinist & Pianist',loc:'Surabaya, Indonesia',desc:'Blending musical creativity with media production. (Edit detail di script.js)',ach:[],tech:['Violin','Piano']},
  {co:'Podcaster',per:'2020 - Present',role:'Host',sub:'Podcaster',loc:'Surabaya, Indonesia',desc:'Producing and hosting digital podcast program that focuses on various discussions, youth trends, and in-depth interviews with interesting guests.',
   ach:['Successfully produced and distributed 2 podcast episodes on Spotify and participated in live radio broadcasts.','Built audience engagement organically, reaching thousands of total listeners (streams) through consistent, informative content.','Managed the entire podcast production cycle independently, from scriptwriting and interview techniques to audio editing.'],
   tech:['Scriptwriting','Audio Editing','Interviewing Skills','Content Strategy','Digital Distribution']}
];
const skills = {
  Programming:[['HTML/CSS',90],['JavaScript',80],['PHP',75],['Python',80],['C/C++',70]],
  Management:[['Team Leadership',85],['Project Management',80],['Content Planning',80]],
  Communication:[['Mandarin',85],['English',90],['Translation',90],['Public Speaking',80]],
  'Music & Arts':[['Violin',75],['Piano',70],['Audio Production',80]],
  Deployment:[['Vercel',75],['Git/GitHub',80],['XAMPP Hosting',85]],
  Tools:[['VS Code',95],['Figma',80],['Postman',85],['XAMPP',85],['Vite',85],['Audacity',80],["Ren'Py Engine",90],['Git Bash',80]]
};
const $ = s => document.querySelector(s);

// Experience tabs
const et = $('#expTabs'), eb = $('#expBody');
function showExp(i){
  const e = experiences[i];
  [...et.children].forEach((b,j)=>b.classList.toggle('on',i===j));
  eb.innerHTML = `<div class="row"><h5 class="xl">${e.role}</h5><span class="chip-o">${e.per}</span></div>
  <p class="role">${e.sub||e.co} · <span class="mut">${e.loc}</span></p><p class="mut small">${e.desc}</p>
  ${e.ach.length?`<small class="k">KEY ACHIEVEMENTS</small><ul class="ach">${e.ach.map(a=>`<li>✓ ${a}</li>`).join('')}</ul>`:''}
  <small class="k">TECHNOLOGIES</small><div class="chips">${e.tech.map(t=>`<span>${t}</span>`).join('')}</div>`;
}
experiences.forEach((e,i)=>{const b=document.createElement('button');b.innerHTML=`<b>${e.co}</b><small>${e.per}</small>`;b.onclick=()=>showExp(i);et.appendChild(b)});
showExp(experiences.length-1);

// Skill tabs
const st = $('#skillTabs'), sg = $('#skillGrid');
function showSkill(cat){
  [...st.children].forEach(b=>b.classList.toggle('on',b.dataset.c===cat));
  sg.innerHTML = skills[cat].map(([n,p])=>`<div class="card"><span class="x">✖</span><b>${n}</b><div class="bar"><i style="width:0" data-w="${p}"></i></div><small class="pc">${p}%</small></div>`).join('');
  requestAnimationFrame(()=>setTimeout(()=>sg.querySelectorAll('i').forEach(i=>i.style.width=i.dataset.w+'%'),30));
}
Object.keys(skills).forEach(c=>{const b=document.createElement('button');b.textContent=c;b.dataset.c=c;b.onclick=()=>showSkill(c);st.appendChild(b)});
showSkill('Tools');

// Counters
const io = new IntersectionObserver(es=>es.forEach(e=>{
  if(!e.isIntersecting) return; io.unobserve(e.target);
  const el=e.target, n=+el.dataset.n, s=el.dataset.s||'+'; let c=0;
  const t=setInterval(()=>{c+=Math.max(1,Math.ceil(n/40));if(c>=n){c=n;clearInterval(t)}el.textContent=c+s},30);
}));
document.querySelectorAll('[data-n]').forEach(el=>io.observe(el));

// Reveal on scroll
const rv = new IntersectionObserver(es=>es.forEach(e=>e.isIntersecting&&e.target.classList.add('show')),{threshold:.1});
document.querySelectorAll('.sec .head,.card,.pcard').forEach(el=>{el.classList.add('rv');rv.observe(el)});

// Active nav link
const secs=[...document.querySelectorAll('section[id]')], links=[...document.querySelectorAll('.links a')];
addEventListener('scroll',()=>{
  let cur='';secs.forEach(s=>{if(scrollY>=s.offsetTop-120)cur=s.id});
  links.forEach(a=>a.classList.toggle('on',a.getAttribute('href')==='#'+cur));
});

// Dark mode
const root=document.documentElement;
try{if(localStorage.theme==='dark')root.dataset.theme='dark'}catch(e){}
$('#theme').onclick=()=>{const d=root.dataset.theme==='dark';root.dataset.theme=d?'light':'dark';try{localStorage.theme=root.dataset.theme}catch(e){}};

// Contact form
$('#form').addEventListener('submit',async e=>{
  e.preventDefault(); const m=$('#formMsg'); m.textContent='Mengirim...';
  try{
    const r=await fetch('contact.php',{method:'POST',body:new FormData(e.target)});
    const j=await r.json(); m.textContent=j.msg; m.style.color=j.ok?'#16a34a':'#dc2626'; if(j.ok)e.target.reset();
  }catch(err){m.textContent='Gagal mengirim. Pastikan dijalankan lewat server PHP (XAMPP).';m.style.color='#dc2626'}
});