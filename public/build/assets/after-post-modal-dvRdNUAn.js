document.addEventListener("DOMContentLoaded",function(){const e=document.getElementById("shareModal"),d=document.getElementById("closeModal");e&&(e.classList.remove("hidden"),d.addEventListener("click",function(){e.classList.add("hidden")}),e.addEventListener("click",function(t){t.target===e&&e.classList.add("hidden")}))});