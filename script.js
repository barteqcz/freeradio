document.addEventListener('DOMContentLoaded', function () {
    let daySelect = document.getElementById("program-days");
    let currentDate = new Date();
    let day = currentDate.getDay();
    if (day == "0") { daySelect.value = "ne"; }
    else if (day == "1") { daySelect.value = "po"; }
    else if (day == "2") { daySelect.value = "ut"; }
    else if (day == "3") { daySelect.value = "st"; }
    else if (day == "4") { daySelect.value = "ct"; }
    else if (day == "5") { daySelect.value = "pa"; }
    else if (day == "6") { daySelect.value = "so"; }
    updateDay();
});

function hamburgerMenu() {
    let x = document.getElementById("myLinks");
    let y = document.getElementById("main")
    if (x.style.display === "flex") {
      x.style.display = "none";
      y.style.marginTop = "200px";
    } else {
      x.style.display = "flex";
      y.style.marginTop = "400px";
    }
}

function hamburgerMenuHideOnly() {
    let x = document.getElementById("myLinks");
    let y = document.getElementById("main")
    x.style.display = "none";
    y.style.marginTop = "200px";
}

function updateDay() {
  let daySelect = document.getElementById("program-days");
  let daySelectValue = daySelect.value;
  let content = document.querySelector(".program .day");

  if (daySelectValue == "po") {
      content.innerHTML = '<h2>Ponděli</h2>\
      <p><b>07:00 – 09:00</b>&nbsp;&nbsp;Ranní Šoustancem Free Rádia</p>\
      <p><b>09:00 – 10:00</b>&nbsp;&nbsp;Krimi zprávy Free Rádia</p>\
      <p><b>10:00 – 11:00</b>&nbsp;&nbsp;Tajemný film Free Rádia</p>\
      <p><b>11:00 – 12:00</b>&nbsp;&nbsp;Celebrity Show Free Rádia</p>\
      <p><b>12:00 – 14:00</b>&nbsp;&nbsp;Žijeme Brnem</p>\
      <p><b>14:00 – 17:00</b>&nbsp;&nbsp;Odpolední FreePárty</p>\
      <p><b>17:00 - 20:00</b>&nbsp;&nbsp;Freebox Free Rádia</p>';
  }
  else if (daySelectValue == "ut") {
      content.innerHTML = '<h2>Úterý</h2>\
      <p><b>07:00 – 09:00</b>&nbsp;&nbsp;Ranní Šoustancem Free Rádia</p>\
      <p><b>09:00 – 10:00</b>&nbsp;&nbsp;Krimi zprávy Free Rádia</p>\
      <p><b>10:00 – 11:00</b>&nbsp;&nbsp;Tajemný film Free Rádia</p>\
      <p><b>11:00 – 12:00</b>&nbsp;&nbsp;Celebrity Show Free Rádia</p>\
      <p><b>12:00 – 14:00</b>&nbsp;&nbsp;Žijeme Brnem</p>\
      <p><b>14:00 – 17:00</b>&nbsp;&nbsp;Odpolední FreePárty</p>\
      <p><b>17:00 - 20:00</b>&nbsp;&nbsp;Freebox Free Rádia</p>';
  }
  else if (daySelectValue == "st") {
      content.innerHTML = '<h2>Středa</h2>\
      <p><b>07:00 – 09:00</b>&nbsp;&nbsp;Ranní Šoustancem Free Rádia</p>\
      <p><b>09:00 – 10:00</b>&nbsp;&nbsp;Krimi zprávy Free Rádia</p>\
      <p><b>10:00 – 11:00</b>&nbsp;&nbsp;Tajemný film Free Rádia</p>\
      <p><b>11:00 – 12:00</b>&nbsp;&nbsp;Celebrity Show Free Rádia</p>\
      <p><b>12:00 – 14:00</b>&nbsp;&nbsp;Žijeme Brnem</p>\
      <p><b>14:00 – 17:00</b>&nbsp;&nbsp;Odpolední FreePárty</p>\
      <p><b>17:00 - 20:00</b>&nbsp;&nbsp;Freebox Free Rádia</p>';
  }
  else if (daySelectValue == "ct") {
      content.innerHTML = '<h2>Čtvrtek</h2>\
      <p><b>07:00 – 09:00</b>&nbsp;&nbsp;Ranní Šoustancem Free Rádia</p>\
      <p><b>09:00 – 10:00</b>&nbsp;&nbsp;Krimi zprávy Free Rádia</p>\
      <p><b>10:00 – 11:00</b>&nbsp;&nbsp;Tajemný film Free Rádia</p>\
      <p><b>11:00 – 12:00</b>&nbsp;&nbsp;Celebrity Show Free Rádia</p>\
      <p><b>12:00 – 14:00</b>&nbsp;&nbsp;Žijeme Brnem</p>\
      <p><b>14:00 – 17:00</b>&nbsp;&nbsp;Odpolední FreePárty</p>\
      <p><b>17:00 - 20:00</b>&nbsp;&nbsp;Freebox Free Rádia</p>';
  }
  else if (daySelectValue == "pa") {
      content.innerHTML = '<h2>Pátek</h2>\
      <p><b>07:00 – 09:00</b>&nbsp;&nbsp;Ranní Šoustancem Free Rádia</p>\
      <p><b>09:00 – 10:00</b>&nbsp;&nbsp;Krimi zprávy Free Rádia</p>\
      <p><b>10:00 – 11:00</b>&nbsp;&nbsp;Tajemný film Free Rádia</p>\
      <p><b>11:00 – 12:00</b>&nbsp;&nbsp;Celebrity Show Free Rádia</p>\
      <p><b>12:00 – 14:00</b>&nbsp;&nbsp;Žijeme Brnem</p>\
      <p><b>14:00 – 16:00</b>&nbsp;&nbsp;Odpolední FreePárty</p>\
      <p><b>16:00 - 20:00</b>&nbsp;&nbsp;Hitparáda Stosedmička Freečka</p>';
  }
  else if (daySelectValue == "so") {
      content.innerHTML = '<h2>Sobota</h2>\
      <p><b>09:00 – 14:00</b>&nbsp;&nbsp;Víkendovky Free Rádia</p>\
      <p><b>14:00 – 19:00</b>&nbsp;&nbsp;Sobotní odpoledne s Free rádiem</p>'
  }
  else if (daySelectValue == "ne") {
      content.innerHTML = '<h2>Neděle</h2>\
      <p><b>09:00 – 13:00</b>&nbsp;&nbsp;Víkendovky Free Rádia</p>\
      <p><b>13:00 – 17:00</b>&nbsp;&nbsp;Hitparáda Stosedmička Freečka [repríza]</p>\
      <p><b>17:00 – 20:00</b>&nbsp;&nbsp;Nedělní Retroparty Free Rádia</p>\
      <p><b>20:00 - 22:00</b>&nbsp;&nbsp;House 4 U</p>'
  }
}
