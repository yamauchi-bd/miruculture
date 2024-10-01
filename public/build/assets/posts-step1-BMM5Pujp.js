document.addEventListener("DOMContentLoaded",function(){console.log("Step 1: DOMContentLoaded event fired"),i(),u(),y()});function i(){if(!document.getElementById("job-categories")){console.error("job-categories element not found");return}}function u(){document.querySelector("form").addEventListener("submit",function(o){o.preventDefault(),m()?this.submit():console.log("フォームのバリデーションに失敗しました")})}function m(){const l=document.querySelectorAll("input[required], select[required], textarea[required]");let o=!0;l.forEach(t=>{let e;if(t.type==="radio"){e=document.getElementById(`${t.name}-error`);const n=document.querySelectorAll(`input[name="${t.name}"]`);Array.from(n).some(d=>d.checked)?(n.forEach(d=>d.classList.remove("error")),e&&(e.style.display="none")):(o=!1,n.forEach(d=>d.classList.add("error")),e&&(e.textContent="このフィールドは必須です。",e.style.display="block"))}else t.type==="select-one"?(e=document.getElementById(`${t.id}-error`),t.value===""?(o=!1,t.classList.add("error"),e&&(e.textContent="このフィールドは必須です。",e.style.display="block")):(t.classList.remove("error"),e&&(e.style.display="none"))):t.value.trim()?(t.classList.remove("error"),e&&(e.style.display="none")):(e=document.getElementById(`${t.id}-error`),o=!1,t.classList.add("error"),e&&(e.textContent="このフィールドは必須です。",e.style.display="block"))});const c=document.querySelector('input[name="status"]:checked'),s=document.getElementById("end_year"),r=document.getElementById("end_year-error");return c&&c.value==="退職済み"&&(!s.value||s.value==="")?(o=!1,s.classList.add("error"),r&&(r.textContent="退職年を選択してください。",r.style.display="block")):(s.classList.remove("error"),r&&(r.style.display="none")),o}function y(){const l=document.querySelectorAll('input[name="status"]'),o=document.getElementById("start_year"),c=document.getElementById("end_year");o.addEventListener("change",function(){s()});function s(){const t=parseInt(o.value),e=new Date().getFullYear();c.innerHTML='<option value="" selected disabled>退職年</option>';for(let n=t;n<=e;n++){const a=document.createElement("option");a.value=n,a.textContent=n+"年",c.appendChild(a)}r()}function r(){var a;const t=document.getElementById("end_year");if(!t)return;const e=((a=document.querySelector('input[name="status"]:checked'))==null?void 0:a.value)==="在籍中";t.style.display=e?"none":"inline-block",t.disabled=e,t.required=!e,e&&(t.value="");const n=document.getElementById("end_year-error");n&&(n.style.display="none")}l.forEach(t=>{t.addEventListener("change",r)}),s(),r()}