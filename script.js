AOS.init({ duration: 1000, once: true });
const menuBtn = document.getElementById('menu-btn');
const mobileMenu = document.getElementById('mobile-menu');
if (menuBtn && mobileMenu) {
    menuBtn.addEventListener('click', () => { mobileMenu.classList.toggle('hidden'); });
}
const themeToggleBtn = document.getElementById('theme-toggle');
const themeToggleMobileBtn = document.getElementById('theme-toggle-mobile');
function applyTheme(isDark) {
    if (isDark) {
        document.documentElement.classList.add('dark');
        if(themeToggleBtn) themeToggleBtn.innerHTML = '<i class="fa-solid fa-moon text-amber-300"></i>';
        if(themeToggleMobileBtn) themeToggleMobileBtn.innerHTML = '<i class="fa-solid fa-moon text-amber-300"></i>';
    } else {
        document.documentElement.classList.remove('dark');
        if(themeToggleBtn) themeToggleBtn.innerHTML = '<i class="fa-solid fa-sun text-amber-400"></i>';
        if(themeToggleMobileBtn) themeToggleMobileBtn.innerHTML = '<i class="fa-solid fa-sun text-amber-400"></i>';
    }
}
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    applyTheme(true);
} else { applyTheme(false); }
function toggleTheme() {
    if (document.documentElement.classList.contains('dark')) {
        applyTheme(false); localStorage.setItem('color-theme', 'light');
    } else {
        applyTheme(true); localStorage.setItem('color-theme', 'dark');
    }
}
if(themeToggleBtn) themeToggleBtn.addEventListener('click', toggleTheme);
if(themeToggleMobileBtn) themeToggleMobileBtn.addEventListener('click', toggleTheme);

fetch('https://api.myquran.com/v2/sholat/jadwal/1204/' + new Date().getFullYear() + '/' + (new Date().getMonth()+1) + '/' + new Date().getDate())
    .then(response => response.json())
    .then(data => {
        if(data.status && data.data.jadwal) {
            const j = data.data.jadwal;
            document.getElementById('subuh').innerText = j.subuh;
            document.getElementById('dzuhur').innerText = j.dzuhur;
            document.getElementById('ashar').innerText = j.ashar;
            document.getElementById('maghrib').innerText = j.maghrib;
            document.getElementById('isya').innerText = j.isya;
        }
    }).catch(err => console.log(err));

function playAzanSound() {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const osc = ctx.createOscillator();
    const gain = ctx.createGain();
    osc.type = 'sine';
    osc.frequency.setValueAtTime(440, ctx.currentTime);
    gain.gain.setValueAtTime(0.1, ctx.currentTime);
    osc.connect(gain);
    gain.connect(ctx.destination);
    osc.start();
    osc.stop(ctx.currentTime + 1.5);
    alert("Simulasi Suara Pengingat Azan Berbunyi!");
}

const now = new Date();
const year = now.getFullYear();
const month = now.getMonth();
const monthsName = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
document.getElementById('calendar-month-year').innerText = monthsName[month] + " " + year;
const firstDay = new Date(year, month, 1).getDay();
const daysInMonth = new Date(year, month + 1, 0).getDate();
const calendarDays = document.getElementById('calendar-days');
let html = '';
for (let i = 0; i < firstDay; i++) { html += '<div></div>'; }
for (let d = 1; d <= daysInMonth; d++) {
    let isToday = (d === now.getDate()) ? 'bg-[#078B4F] text-white font-bold rounded-full' : 'hover:bg-slate-200 dark:hover:bg-slate-700 rounded-full';
    html += `<div class="py-1.5 ${isToday}">${d}</div>`;
}
calendarDays.innerHTML = html;
