let data = {}
const p = document.getElementById('display-grade');


Papa.parse("./DS-grades-F24u-EECS.csv", {
	download: true,
    encoding: "utf-8",
    complete: function(results) {
        let header = results.data.slice(0, 1)[0];
        let res = results.data.slice(1);

        grades = res.map(item => {
            let grade = {};
            for (i = 0; i < header.length; i++) {
                grade[header[i]] = item[i];
            }
            return grade;
        })

        for (const grade of grades) {
            data[grade[`序號`]]= grade;
        }
	}
})

function display() {
    const id = document.getElementById('sid-mid').value;
    if (id=="") return;
    // p.innerText = JSON.stringify(data[id]);
    const display = `
    SID:${data[id].學號}
    H1: ${data[id].H1}
    H2: ${data[id].H2}
    H3: ${data[id].H3}
    H4: ${data[id].H4}
    Mid: ${data[id].Mid}
    Fin: ${data[id].Fin}
    CPE: ${data[id].CPE}
    ** SEM: ${data[id].Sem}
    The grade SEM is determined by the following rule: (H1+H2+H3+H4)/4*0.4+SQRT(Mid)*10*0.25+SQRT(FIN)*10*0.35+CPE.
    Note that the highest grade of this course is 99. If your final grade is large than 99, then you will get 99 at most.
    `;
    p.innerText = display;
}
