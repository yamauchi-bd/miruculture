document.addEventListener("DOMContentLoaded",function(){c(),i(),setupShareModal()});function c(){document.querySelectorAll('input[type="range"]').forEach(e=>{u(e),e.addEventListener("input",function(){u(this)})})}function u(t){const e=t.min||1,o=t.max||5,r=(t.value-e)/(o-e)*100;t.style.background=`linear-gradient(to right, #0891b2 0%, #0891b2 ${r}%, #d1d5db ${r}%, #d1d5db 100%)`}function i(){const t=document.querySelector("form");document.getElementById("submit-button"),t.addEventListener("submit",function(e){e.preventDefault(),d()?this.submit():alert("フォームのバリデーションに失敗しました。すべての必須項目を入力してください。")})}function d(){const t=document.querySelectorAll('input[type="range"]');let e=!0;t.forEach(n=>{n.value?a(n.name):(e=!1,s(n.name))});const o=document.getElementById("submit-button");return o.disabled=!e,o.classList.toggle("opacity-50",!e),e}function s(t){if(!document.getElementById(`${t}-error`)){const o=document.querySelector(`input[name="${t}"]`).closest(".mb-10"),n=document.createElement("p");n.id=`${t}-error`,n.className="text-red-500 text-xs mt-1",n.textContent="この項目は必須です",o.appendChild(n)}}function a(t){const e=document.getElementById(`${t}-error`);e&&e.remove()}
