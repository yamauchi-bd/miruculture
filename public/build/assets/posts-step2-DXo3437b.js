document.addEventListener("DOMContentLoaded",function(){d(),m(),f(),h(),p(),g(),v()});function d(){for(let t=2;t<=3;t++)u(t)}function u(t){const e=document.querySelectorAll(`input[name="deciding_factor_${t}"]`),o=document.getElementById(`factor_${t}_detail`),c=document.querySelectorAll(`input[name="factor_${t}_satisfaction"]`);e.forEach(a=>{a.addEventListener("change",function(){const n=document.querySelector(`input[name="deciding_factor_${t}"]:checked`)!==null;console.log(`Factor ${t} selected: ${n}`),o.required=n,c.forEach(i=>i.required=n),reason.required=n})})}function f(){const t=document.getElementById("add-factor-button"),e=document.getElementById("factor-2"),o=document.getElementById("factor-3");t.addEventListener("click",function(){e.classList.contains("hidden")?e.classList.remove("hidden"):o.classList.contains("hidden")&&(o.classList.remove("hidden"),t.style.display="none")})}function m(){document.querySelectorAll(".factor-label").forEach(e=>{e.addEventListener("click",function(o){o.preventDefault();const c=this.previousElementSibling,a=c.name;c.checked=!c.checked,document.querySelectorAll(`input[name="${a}"]`).forEach(n=>{n!==c&&(n.checked=!1)}),y(a),updateAvailableOptions()})})}function y(t){document.querySelectorAll(`input[name="${t}"] + .factor-label`).forEach(e=>{e.previousElementSibling.checked?(e.classList.add("bg-cyan-500","text-white"),e.classList.remove("bg-white","text-gray-700")):(e.classList.remove("bg-cyan-500","text-white"),e.classList.add("bg-white","text-gray-700"))})}function h(){const t=document.querySelectorAll(".deciding-factor"),e={};t.forEach(c=>{const a=c.getAttribute("name");e[a]||(e[a]=[]),e[a].push(c)});function o(){const c=new Set;Object.values(e).forEach(a=>{a.forEach(n=>{n.checked&&c.add(n.value)})}),Object.values(e).forEach(a=>{a.forEach(n=>{const i=n.nextElementSibling;c.has(n.value)&&!n.checked?(n.disabled=!0,i.classList.add("opacity-50","cursor-not-allowed"),i.style.pointerEvents="none"):(n.disabled=!1,i.classList.remove("opacity-50","cursor-not-allowed"),i.style.pointerEvents="auto")})})}o(),window.updateAvailableOptions=o}function p(){document.querySelectorAll(".flex.items-center").forEach(e=>{const o=e.querySelectorAll("svg");o.forEach((c,a)=>{c.addEventListener("click",()=>{o.forEach((n,i)=>{i<=a?(n.classList.add("text-cyan-500"),n.classList.remove("text-gray-300")):(n.classList.add("text-gray-300"),n.classList.remove("text-cyan-500"))})})})})}function g(){document.querySelector("form").addEventListener("submit",function(e){e.preventDefault(),E()?this.submit():console.log("フォームのバリデーションに失敗しました")})}function E(){let t=!0;for(let e=1;e<=3;e++){const o=document.querySelectorAll(`input[name="deciding_factor_${e}"]`),c=document.getElementById(`factor_${e}_detail`),a=document.querySelectorAll(`input[name="factor_${e}_satisfaction"]`),n=Array.from(o).some(s=>s.checked),i=Array.from(a).some(s=>s.checked);(e===1||n)&&(n?l(`deciding_factor_${e}-error`):(t=!1,r(`deciding_factor_${e}-error`,"入社の決め手を選択してください。")),c.value.length<100?(t=!1,r(`factor_${e}_detail-error`,"詳細は100文字以上入力してください。")):l(`factor_${e}_detail-error`),i?l(`factor_${e}_satisfaction-error`):(t=!1,r(`factor_${e}_satisfaction-error`,"満足度を選択してください。")))}return t}function r(t,e){const o=document.getElementById(t);o&&(o.textContent=e,o.style.display="block")}function l(t){const e=document.getElementById(t);e&&(e.style.display="none")}function v(){for(let t=1;t<=3;t++){const e=document.getElementById(`factor_${t}_detail`),o=document.getElementById(`factor_${t}_detail_count`);e&&o&&e.addEventListener("input",function(){o.textContent=this.value.length})}}
