document.addEventListener("DOMContentLoaded",function(){console.log("DOMContentLoaded event fired"),h(),v(),B(),I(),k()});function h(){const n=document.getElementById("job-categories");if(!n){console.error("job-categories element not found");return}const r=JSON.parse(n.dataset.categories),e=document.getElementById("job_category");if(!e){console.error("job_category element not found");return}e.addEventListener("change",function(){E(this.value,r)})}function E(n,r){const e=document.getElementById("job_subcategory");e.innerHTML='<option value="">選択してください</option>',n&&r[n]&&r[n].forEach(c=>{const o=document.createElement("option");o.value=c.id,o.textContent=c.name,e.appendChild(o)})}function v(){for(let n=2;n<=3;n++)b(n);L(),S(),q()}function b(n){const r=document.querySelectorAll(`input[name="deciding_factor_${n}"]`),e=document.getElementById(`factor_${n}_detail`),c=document.querySelectorAll(`input[name="factor_${n}_satisfaction"]`),o=document.getElementById(`factor_${n}_satisfaction_reason`);r.forEach(s=>{s.addEventListener("change",function(){const t=document.querySelector(`input[name="deciding_factor_${n}"]:checked`)!==null;console.log(`Factor ${n} selected: ${t}`),e.required=t,c.forEach(a=>a.required=t),o.required=t})})}function L(){document.querySelectorAll(".deciding-factor").forEach(r=>{r.addEventListener("change",function(){if(document.querySelectorAll(`[name="${this.name}"] + .factor-label`).forEach(e=>{e.classList.remove("bg-cyan-500","text-white","border-cyan-500"),e.classList.add("bg-white","hover:bg-gray-100","text-gray-700","border-gray-300")}),this.checked){const e=this.nextElementSibling;e.classList.remove("bg-white","hover:bg-gray-100","text-gray-700","border-gray-300"),e.classList.add("bg-cyan-500","text-white","border-cyan-500")}})})}function S(){const n=document.getElementById("add-factor-button"),r=document.querySelectorAll("#deciding-factors > div");let e=1;n.addEventListener("click",function(){e<3&&(e++,r[e-1].classList.remove("hidden"),e===3&&(n.style.display="none"))})}function q(){const n=document.querySelectorAll(".deciding-factor"),r={};n.forEach(c=>{const o=c.getAttribute("name");r[o]||(r[o]=[]),r[o].push(c)});function e(){const c=new Set;Object.values(r).forEach(o=>{o.forEach(s=>{s.checked&&c.add(s.value)})}),Object.values(r).forEach(o=>{o.forEach(s=>{const t=s.nextElementSibling;c.has(s.value)&&!s.checked?(s.disabled=!0,t.classList.add("opacity-50","cursor-not-allowed")):(s.disabled=!1,t.classList.remove("opacity-50","cursor-not-allowed"))})})}n.forEach(c=>{c.addEventListener("change",e)}),e()}function B(){document.querySelectorAll(".flex.items-center").forEach(r=>{const e=r.querySelectorAll("svg"),c=r.querySelectorAll('input[type="radio"]');function o(t){e.forEach((a,i)=>{i<=t?(a.classList.add("text-cyan-500"),a.classList.remove("text-gray-300")):(a.classList.remove("text-cyan-500"),a.classList.add("text-gray-300"))})}c.forEach((t,a)=>{t.addEventListener("change",()=>{o(a)})}),e.forEach((t,a)=>{t.addEventListener("mouseover",()=>{o(a)}),t.addEventListener("mouseout",()=>{const i=r.querySelector('input[type="radio"]:checked');o(i?Array.from(c).indexOf(i):-1)}),t.addEventListener("click",()=>{c[a].checked=!0,o(a)})});const s=r.querySelector('input[type="radio"]:checked');s&&o(Array.from(c).indexOf(s))})}function I(){const n=document.getElementById("next-button"),r=document.getElementById("back-button");document.getElementById("submit-button");const e=document.getElementById("section-1"),c=document.getElementById("section-2"),o=document.getElementById("progress-bar"),s=document.getElementById("progress-bar-2"),t=document.getElementById("step-2");n.addEventListener("click",function(i){i.preventDefault(),a()?(e.classList.add("hidden"),c.classList.remove("hidden"),o.style.width="100%",s.style.width="30%",t.classList.remove("bg-white","border-2","border-gray-300"),t.classList.add("bg-cyan-500"),t.querySelector("span").classList.remove("text-gray-500"),t.querySelector("span").classList.add("text-white"),window.scrollTo({top:0,behavior:"smooth"})):console.log("フォームのバリデーションに失敗しました")}),r.addEventListener("click",function(){c.classList.add("hidden"),e.classList.remove("hidden"),o.style.width="30%",s.style.width="0%",t.classList.add("bg-white","border-2","border-gray-300"),t.classList.remove("bg-cyan-500"),t.querySelector("span").classList.add("text-gray-500"),t.querySelector("span").classList.remove("text-white")});function a(){const i=e.querySelectorAll("input[required], select[required], textarea[required]");let u=!0;i.forEach(l=>{let d;if(l.type==="radio"){d=document.getElementById(`${l.name}-error`);const g=e.querySelectorAll(`input[name="${l.name}"]`);Array.from(g).some(y=>y.checked)?(g.forEach(y=>y.classList.remove("error")),d&&(d.style.display="none")):(u=!1,g.forEach(y=>y.classList.add("error")),d&&(d.textContent="このフィールドは必須です。",d.style.display="block"))}else l.type==="select-one"?(d=document.getElementById(`${l.id}-error`),l.value===""?(u=!1,l.classList.add("error"),d&&(d.textContent="このフィールドは必須です。",d.style.display="block")):(l.classList.remove("error"),d&&(d.style.display="none"))):l.value.trim()?(l.classList.remove("error"),d&&(d.style.display="none")):(d=document.getElementById(`${l.id}-error`),u=!1,l.classList.add("error"),d&&(d.textContent="このフィールドは必須です。",d.style.display="block"))});const p=document.querySelector('input[name="status"]:checked'),f=document.getElementById("end_year"),m=document.getElementById("end_year-error");return p&&p.value==="退職済み"&&(!f.value||f.value==="")?(u=!1,f.classList.add("error"),m&&(m.textContent="退職年を選択してください。",m.style.display="block")):(f.classList.remove("error"),m&&(m.style.display="none")),u}}function k(){const n=document.querySelectorAll('input[name="status"]'),r=document.getElementById("start_year"),e=document.getElementById("end_year");r.addEventListener("change",function(){c()});function c(){const s=parseInt(r.value),t=new Date().getFullYear();e.innerHTML='<option value="" selected disabled>退職年</option>';for(let a=s;a<=t;a++){const i=document.createElement("option");i.value=a,i.textContent=a+"年",e.appendChild(i)}o()}function o(){var i;const s=document.getElementById("end_year");if(!s)return;const t=((i=document.querySelector('input[name="status"]:checked'))==null?void 0:i.value)==="在籍中";s.style.display=t?"none":"inline-block",s.disabled=t,s.required=!t,t&&(s.value="");const a=document.getElementById("end_year-error");a&&(a.style.display="none")}n.forEach(s=>{s.addEventListener("change",o)}),c(),o()}