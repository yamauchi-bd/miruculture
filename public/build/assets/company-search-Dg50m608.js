document.addEventListener("DOMContentLoaded",function(){const s=document.getElementById("company-search"),n=document.getElementById("search-results"),a=document.getElementById("search-button");let i;s.addEventListener("input",function(){clearTimeout(i),i=setTimeout(()=>{const e=this.value.trim();e.length>1?r(e):(n.innerHTML="",n.classList.add("hidden"))},300)}),a.addEventListener("click",function(e){e.preventDefault();const c=s.value.trim();c.length>1&&r(c)}),console.log("appUrl:",window.appUrl);function r(e){const c=`${window.appUrl}/companies/search?query=${encodeURIComponent(e)}`;console.log("Fetching from:",c),fetch(c).then(t=>{if(!t.ok)throw new Error(`HTTP error! status: ${t.status}`);return t.json()}).then(t=>{d(t)}).catch(t=>{console.error("Error:",t),n.innerHTML='<p class="p-2 text-red-500">検索中にエラーが発生しました。</p>',n.classList.remove("hidden")})}function d(e){if(n.innerHTML="",e.length===0)n.innerHTML='<p class="p-2">検索結果がありません。</p>';else{const c=document.createElement("ul");c.className="divide-y divide-gray-200",e.forEach(t=>{const o=document.createElement("li");o.className="p-2 hover:bg-gray-100 cursor-pointer",o.innerHTML=`
                    <div class="font-medium">${t.company_name}</div>
                    <div class="text-xs text-gray-500">${t.location}</div>
                `,o.addEventListener("click",()=>{window.location.href=`/companies/${t.corporate_number}`}),c.appendChild(o)}),n.appendChild(c)}n.classList.remove("hidden")}document.addEventListener("click",function(e){!n.contains(e.target)&&e.target!==s&&n.classList.add("hidden")})});