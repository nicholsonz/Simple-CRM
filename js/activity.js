// Income Line Chart
const labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
let clientlbls = [{monthname: "Jan",clientnum: "0"},{monthname: "Feb",clientnum: "0"},{monthname: "Mar",clientnum: "0"},
                  {monthname: "Apr",clientnum: "0"},{monthname: "May",clientnum: "0"},{monthname: "Jun",clientnum: "0"},
                  {monthname: "Jul",clientnum: "0"},{monthname: "Aug",clientnum: "0"},{monthname: "Sep",clientnum: "0"},
                  {monthname: "Oct",clientnum: "0"},{monthname: "Nov",clientnum: "0"},{monthname: "Dec",clientnum: "0"},];
let leadlbls = [{monthname: "Jan",leadnum: "0"},{monthname: "Feb",leadnum: "0"},{monthname: "Mar",leadnum: "0"},
                  {monthname: "Apr",leadnum: "0"},{monthname: "May",leadnum: "0"},{monthname: "Jun",leadnum: "0"},
                  {monthname: "Jul",leadnum: "0"},{monthname: "Aug",leadnum: "0"},{monthname: "Sep",leadnum: "0"},
                  {monthname: "Oct",leadnum: "0"},{monthname: "Nov",leadnum: "0"},{monthname: "Dec",leadnum: "0"},];

  // Push properties from mnthclients to clientlbls
  if (! clientlbls.includes(mnthclients)) {
    for (const clientnum of mnthclients){
        clientlbls.push(clientnum)
      }
  }
 // Remove duplicate monthnames from clientlbls
 function getUniqueListBy(clientlbls, key) {
  return [...new Map(clientlbls.map(item => [item[key], item])).values()]
}
const clientlblsnew = getUniqueListBy(clientlbls, 'monthname');

// Push properties from mnthleads to leadlbls
if (! leadlbls.includes(mnthleads)) {
  for (const leadnum of mnthleads){
      leadlbls.push(leadnum)
    }
}
// Remove duplicate monthnames from leadlbls
function getUniqueListBy(leadlbls, key) {
return [...new Map(leadlbls.map(item => [item[key], item])).values()]
}
const leadlblsnew = getUniqueListBy(leadlbls, 'monthname');

// Remove key "monthname:" from clientlblsnew
for (var i = 0, len = clientlblsnew.length; i < len; i++) {
  delete clientlblsnew[i].monthname;
}
// Remove key "monthname:" from clientlblsnew
for (var i = 0, len = leadlblsnew.length; i < len; i++) {
    delete leadlblsnew[i].monthname;
  }
// Dump object array into cllbls array and feed it to chartjs
let cllbls = [];
  for (i of clientlblsnew) {
    cllbls.push(...Object.values(i))
  }
// Dump object array into ldlbls array and feed it to chartjs
let ldlbls = [];
  for (i of leadlblsnew) {
    ldlbls.push(...Object.values(i))
  }

// console.log(cllbls);
// console.log(ldlbls);

// Set some point options
Chart.defaults.elements.point.hoverRadius = 11;
Chart.defaults.elements.point.radius = 7;
Chart.defaults.color = "white";

new Chart(document.getElementById("activityChart"), {
  type: "line",
  data: {
    labels: labels,
    datasets: [
      {
        label: "Clients",
        data: cllbls,
        backgroundColor: [
          "rgba(75, 244, 233, 0.3)",
        ],
        borderColor: [
          "rgba(75, 244, 233, 0.5)",
        ],
        tension: 0.3,
        fill: 'origin'
      },
      {
        label: "Leads",
        data: ldlbls,
        backgroundColor: [
          "rgba(13, 172, 240, 0.3)",
        ],
        borderColor: [
          "rgba(13, 172, 240, 0.5)",
        ],
        tension: 0.3,
        fill: 'origin'
      },
    ],
  },
  options: {
    responsive: true,
    layout: {
      padding: {
        bottom: 5,
        top: 30,
        left: 5,
        right: 5,
      },
    },
      scales: {
        y: {
          border: {
            display: true
          },
          grid: {
            color: "rgba(128,128,128,0.2)"
            }
          },
        x: {
          border: {
            display: true
          },
          grid: {
            display: false,
            color: "rgba(128,128,128,0.2)"
            }
          }
      },
    plugins: {
      legend: {
        display: true,
      },
    },
  },
});
