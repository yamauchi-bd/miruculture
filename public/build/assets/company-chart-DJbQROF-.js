document.addEventListener("DOMContentLoaded",function(){const t=document.getElementById("decidingFactorsChart").getContext("2d"),i=JSON.parse(document.getElementById("decidingFactorsData").textContent),s=t.createLinearGradient(0,0,0,400);s.addColorStop(0,"rgba(8, 145, 178, 1)");const r=t.createLinearGradient(0,0,0,400);r.addColorStop(0,"rgba(6, 182, 212, 1)");const o=t.createLinearGradient(0,0,0,400);o.addColorStop(0,"rgba(93, 217, 217, 1)");const n={type:"bar",data:{labels:i.map(e=>e.factor),datasets:[{label:"1位",data:i.map(e=>e.percentages[0]),backgroundColor:s},{label:"2位",data:i.map(e=>e.percentages[1]),backgroundColor:r},{label:"3位",data:i.map(e=>e.percentages[2]),backgroundColor:o}]},options:{indexAxis:"y",responsive:!0,maintainAspectRatio:!1,barThickness:20,scales:{x:{stacked:!0,max:100,ticks:{callback:function(e){return e+"%"},font:{family:"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",size:10}},grid:{display:!1}},y:{stacked:!0,ticks:{font:{family:"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",size:12}},grid:{display:!1}}},plugins:{legend:{position:"bottom",labels:{usePointStyle:!0,padding:20,font:{family:"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",size:12}}},tooltip:{backgroundColor:"rgba(0, 0, 0, 0.8)",titleFont:{family:"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",size:10},bodyFont:{family:"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",size:10},callbacks:{label:function(e){let a=e.dataset.label||"";return a&&(a+=": "),e.parsed.x!==null&&(a+=e.parsed.x.toFixed(1)+"%"),a},afterBody:function(e){e.reduce((a,l)=>a+l.parsed.x,0)}}}}}};window.innerWidth<=640&&(n.options.scales.y.ticks.font.size=10,n.options.barThickness=10),new Chart(t,n)});
