document.addEventListener("DOMContentLoaded",function(){f(),h(),y(),p(),E(),v(),b(),S()});function f(){for(let t=2;t<=3;t++)m(t)}function m(t){const e=document.querySelectorAll(`input[name="factor_${t}"]`),c=document.getElementById(`detail_${t}`),o=document.querySelectorAll(`input[name="satisfaction_${t}"]`);e.forEach(a=>{a.addEventListener("change",function(){const n=document.querySelector(`input[name="factor_${t}"]:checked`)!==null;console.log(`Factor ${t} selected: ${n}`),c.required=n,o.forEach(s=>s.required=n)})})}function y(){const t=document.getElementById("add-factor-button"),e=document.getElementById("factor-2"),c=document.getElementById("factor-3");t.addEventListener("click",function(){e.classList.contains("hidden")?e.classList.remove("hidden"):c.classList.contains("hidden")&&(c.classList.remove("hidden"),t.style.display="none")})}function h(){document.querySelectorAll(".factor-label").forEach(e=>{e.addEventListener("click",function(c){c.preventDefault();const o=this.previousElementSibling,a=o.name;o.checked=!o.checked,document.querySelectorAll(`input[name="${a}"]`).forEach(n=>{n!==o&&(n.checked=!1)}),g(a),updateAvailableOptions()})})}function g(t){document.querySelectorAll(`input[name="${t}"] + .factor-label`).forEach(e=>{e.previousElementSibling.checked?(e.classList.add("bg-cyan-500","text-white"),e.classList.remove("bg-white","text-gray-700")):(e.classList.remove("bg-cyan-500","text-white"),e.classList.add("bg-white","text-gray-700"))})}function p(){const t=document.querySelectorAll(".deciding-factor"),e={};t.forEach(o=>{const a=o.getAttribute("name");e[a]||(e[a]=[]),e[a].push(o)});function c(){const o=new Set;Object.values(e).forEach(a=>{a.forEach(n=>{n.checked&&o.add(n.value)})}),Object.values(e).forEach(a=>{a.forEach(n=>{const s=n.nextElementSibling;o.has(n.value)&&!n.checked?(n.disabled=!0,s.classList.add("opacity-50","cursor-not-allowed"),s.style.pointerEvents="none"):(n.disabled=!1,s.classList.remove("opacity-50","cursor-not-allowed"),s.style.pointerEvents="auto"),n.checked?(s.classList.add("bg-cyan-500","text-white"),s.classList.remove("bg-white","text-gray-700")):(s.classList.remove("bg-cyan-500","text-white"),s.classList.add("bg-white","text-gray-700"))})})}c(),window.updateAvailableOptions=c}function E(){document.querySelectorAll(".flex.items-center").forEach(e=>{const c=e.querySelectorAll("svg"),o=e.querySelectorAll('input[type="radio"]');c.forEach((a,n)=>{a.addEventListener("click",()=>{o[n].checked=!0,c.forEach((s,i)=>{i<=n?(s.classList.add("text-cyan-500"),s.classList.remove("text-gray-300")):(s.classList.add("text-gray-300"),s.classList.remove("text-cyan-500"))})})})})}function v(){document.querySelector("form").addEventListener("submit",function(e){e.preventDefault(),L()?this.submit():console.log("フォームのバリデーションに失敗しました")})}function L(){let t=!0;for(let e=1;e<=3;e++){const c=document.querySelectorAll(`input[name="factor_${e}"]`),o=document.getElementById(`detail_${e}`),a=document.querySelectorAll(`input[name="satisfaction_${e}"]`),n=Array.from(c).some(i=>i.checked),s=Array.from(a).some(i=>i.checked);(e===1||n)&&(n?d(`factor_${e}-error`):(t=!1,l(`factor_${e}-error`,"入社の決め手を選択してください。")),o.value.length<100?(t=!1,l(`detail_${e}-error`,"詳細は100文字以上入力してください。")):d(`detail_${e}-error`),s?d(`satisfaction_${e}-error`):(t=!1,l(`satisfaction_${e}-error`,"満足度を選択してください。")))}return t}function l(t,e){const c=document.getElementById(t);c&&(c.textContent=e,c.style.display="block")}function d(t){const e=document.getElementById(t);e&&(e.style.display="none")}function b(){for(let t=1;t<=3;t++){const e=document.getElementById(`detail_${t}`),c=document.getElementById(`detail_${t}_count`);e&&c&&e.addEventListener("input",function(){c.textContent=this.value.length})}}function S(){for(let o=1;o<=3;o++){document.querySelectorAll(`input[name="factor_${o}"]`).forEach(s=>{if(s.checked){const i=s.nextElementSibling;if(i.classList.add("bg-cyan-500","text-white"),i.classList.remove("bg-white","text-gray-700"),o>1){const r=document.getElementById(`factor-${o}`);r&&r.classList.remove("hidden")}}});const n=document.querySelector(`input[name="satisfaction_${o}"]:checked`);if(n){const s=n.closest(".flex.items-center").querySelectorAll("svg"),i=parseInt(n.value);s.forEach((r,u)=>{u<i?(r.classList.add("text-cyan-500"),r.classList.remove("text-gray-300")):(r.classList.add("text-gray-300"),r.classList.remove("text-cyan-500"))})}}const t=document.getElementById("factor-2"),e=document.getElementById("factor-3"),c=document.getElementById("add-factor-button");!t.classList.contains("hidden")&&!e.classList.contains("hidden")&&(c.style.display="none"),updateAvailableOptions()}
