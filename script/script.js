/** @format */

console.log("in script 1 ");
document
  .querySelector("#register-btn")
  .addEventListener("click", formRegisteration);
document
  .querySelector("#view-register-btn")
  .addEventListener("click", viewRegisteration);
document.querySelector("#home-btn").addEventListener("click", showHome);

let home = document.querySelector("#home1");
let view = document.querySelector("#view-registration");
let register = document.querySelector("#register-form");

let blockList = {
  home: [home, "home"],
  register: [register, "register"],
  view: [view, "view"],
};

function showHome() {
  console.log("home");
  showBlock("home");
}
function formRegisteration() {
  console.log("register");
  showBlock("register");
}

function viewRegisteration() {
  document.querySelector(".table-output").innerHTML = " ";
  console.log("view registraion");
  getData();
  showBlock("view");
}

/*block display function */
function showBlock(id) {
  for (const key in blockList) {
    if (blockList.hasOwnProperty(key)) {
      const element = blockList[key];

      element[0].style.display = id == key ? "block" : "none";
    }
  }
}

/* input fields variables */

/* register event listerner */

document
  .querySelector("#comfirm-register-btn")
  .addEventListener("click", registeruser);

/* register function */

function registeruser() {
  /* elements  */
  let fnameEle = document.querySelector("#fname");
  let lnameEle = document.querySelector("#lname");
  let email1 = document.querySelector("#email");
  let phnoelement = document.querySelector("#phno");
  let ageelement = document.querySelector("#age ");

  /* elemnt value  */
  let fname = document.querySelector("#fname").value;
  let lname = document.querySelector("#lname").value;
  let email = document.querySelector("#email").value;
  let phno = document.querySelector("#phno").value;
  let age = document.querySelector("#age ").value;
  /*error elements*/
  let ferror = document.querySelector("#fname-error");
  let lerror = document.querySelector("#lname-error");
  let emailerror = document.querySelector("#email-error");
  let telerror = document.querySelector("#tel-error");
  let ageerror = document.querySelector("#age-error");

  /* formating  */

  var letters = /^[A-Za-z]+$/;
  if (fname == "" || fname.length <= 2) {
    ferror.innerHTML = "please enter the valid first name";
    return;
  } else {
    ferror.innerHTML = "";

    if (!fname.match(letters)) {
      ferror.innerHTML = "first name should be only alpha letters";
      return;
    }
    if (lname == "" || lname.length <= 2) {
      lerror.innerHTML = "please enter the valid last name";
      return;
    } else {
      lerror.innerHTML = "";
      if (!lname.match(letters)) {
        lerror.innerHTML = "last name should be only alpha letters";
        return;
      }
      if (!email1.checkValidity()) {
        emailerror.innerHTML = "please enter the valid email";
        return;
      } else {
        emailerror.innerHTML = "";
        if (!phnoelement.checkValidity()) {
          telerror.innerHTML = "please enter the valid phone";
          return;
        } else {
          telerror.innerHTML = "";
          if (!ageelement.checkValidity()) {
            ageerror.innerHTML = "please enter the accurate age ";
            return;
          } else {
            telerror.innerHTML = "";
            if (age < 15 || age >= 100) {
              ageerror.innerHTML = "yor age is not acceptable  ";
              return;
            } else {
              telerror.innerHTML = "";

              console.log(fname, lname, email, phno, age);

              $.get(
                "../rest/restaurant/insert.php",
                {
                  fname: fname,
                  lname: lname,
                  email: email,
                  phone: phno,
                  age: age,
                },
                function (data, status) {
                  showBlock("view");
                  viewRegisteration();
                }
              );
              document.querySelector("#fname").value = "";
              document.querySelector("#lname").value = "";
              document.querySelector("#email").value = "";
              document.querySelector("#phno").value = "";
              document.querySelector("#age ").value = "";
            }
          }
        }
      }
    }
  }
}

function getData() {
  $.get("../rest/restaurant/readAll.php")
    .done((data) => {
      data.records.forEach((item) => {
        document.querySelector("#noreg").style.display = "none";
        let output = `
        <tr>
       
         <td>${item.fname} ${item.lname}</td>
        <td>${item.email}</td>
         <td>${item.phone}</td>
         <td>${item.age}/yrs</td>
         </tr> `;
        document
          .querySelector(".table-output")
          .insertAdjacentHTML("afterbegin", output);
      });
    })
    .fail((err) => {
      console.log("failed");
    });
}

function insertData() {
  $.get("../rest/restaurant/readAll.php")
    .done((data) => {
      data.records.forEach((item) => {
        document.querySelector("#noreg").style.display = "none";
        let output = `
      <tr>
     
      <td>${item.fname} ${item.lname}</td>
      <td>${item.email}</td>
      <td>${item.phone}</td>
      <td>${item.age}/yrs</td>
      </tr> `;
        document
          .querySelector(".table-output")
          .insertAdjacentHTML("afterbegin", output);
      });
    })
    .fail((err) => {
      console.log("failed");
    });
}
