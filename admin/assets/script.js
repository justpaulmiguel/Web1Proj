// Sweet alert library must be loaded first

const YES_CONFIRM_BTN_COLOR = "#a35709";
const NO_CONFIRM_BTN_COLOR = "gray";
const DEFAULT_CONFIRM_BTN_COLOR = "#c85022";

/**
 * Logic for the sliding header upon scroll.
 * works by checking the window Yoffset and adding/removing class.
 */
(() => {
  const scrollUp = "scroll-up";
  const scrollDown = "scroll-down";
  let lastScroll = 0;
  const body = document.body;

  window.addEventListener("scroll", () => {
    const currentScroll = window.pageYOffset;
    if (currentScroll <= 0) {
      body.classList.remove(scrollUp);
      return;
    }

    if (currentScroll > lastScroll && !body.classList.contains(scrollDown)) {
      // Scrolled down
      body.classList.remove(scrollUp);
      body.classList.add(scrollDown);
    } else if (
      currentScroll < lastScroll &&
      body.classList.contains(scrollDown)
    ) {
      // Scrolled up
      body.classList.remove(scrollDown);
      body.classList.add(scrollUp);
    }
    lastScroll = currentScroll;
  });
})();

/***
 * Handles the sidebar animation
 */

(() => {
  const menuBar = document.querySelector("#menu-icon");
  const sideBar = document.querySelector("aside");

  menuBar.addEventListener("click", () => {
    sideBar.classList.toggle("menu-closed");
  });

  const adjustSidebar = () => {
    if (window.innerWidth <= 700) sideBar.classList.add("menu-closed");
    else sideBar.classList.remove("menu-closed");
  };
  window.addEventListener("resize", adjustSidebar);
  window.addEventListener("load", adjustSidebar);
})();

// My information  Logic
if (document.querySelector("#edit-account-form")) {
  // saves the values of the input first before editing.

  let fName = "";
  let lName = "";
  let contactNum = "";
  const hidden = "hidden-btn";

  const formDOM = document.querySelector("#edit-account-form");
  const editBtn = formDOM.querySelector("#btn-edit-info");
  const submitBtn = formDOM.querySelector("#submit-account-details-btn");
  const cancelBtn = formDOM.querySelector("#cancel-account-details-btn");
  const input = formDOM.querySelectorAll(".disabled-input:not(.no-change)");

  editBtn.addEventListener("click", () => {
    if (!editBtn.classList.contains(hidden)) {
      submitBtn.classList.remove(hidden);
      cancelBtn.classList.remove(hidden);
      editBtn.classList.add(hidden);
      fName = formDOM.inputFName.value;
      lName = formDOM.inputLName.value;
      contactNum = formDOM.inputContactNumber.value;
      input.forEach((element) => {
        element.classList.remove("disabled-input");
        element.disabled = false;
      });
    }
  });
  formDOM.addEventListener("submit", (e) => {
    e.preventDefault();
  });
  cancelBtn.addEventListener("click", () => {
    cancelBtn.classList.add(hidden);
    submitBtn.classList.add(hidden);
    editBtn.classList.remove(hidden);

    formDOM.inputFName.value = fName;
    formDOM.inputLName.value = lName;
    formDOM.inputContactNumber.value = contactNum;

    input.forEach((element) => {
      element.classList.add("disabled-input");
      element.disabled = true;
    });
  });
  submitBtn.addEventListener("click", () => {
    if (
      formDOM.inputFName.value.trim().length === 0 ||
      formDOM.inputLName.value.trim().length === 0
    ) {
      Swal.fire({
        title: "Empty Input",
        text: `Please don't leave all textboxes empty!`,
        icon: "error",
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,
        confirmButtonText: "Confirm",
      });
    } else if (
      formDOM.inputFName.value.trim() == fName &&
      formDOM.inputLName.value.trim() === lName &&
      formDOM.inputContactNumber.value === contactNum
    ) {
      Swal.fire({
        title: "Same Details",
        text: `Your details are the same as before!`,
        icon: "warning",
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,
        confirmButtonText: "Confirm",
      });
    } else {
      Swal.fire({
        title: "Account Information",
        text: `Do you want to update your details?`,
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,
        cancelButtonColor: NO_CONFIRM_BTN_COLOR,
        confirmButtonText: "Yes",
      }).then((isConfirmed) => {
        if (isConfirmed) {
          formDOM.submit();
        }
      });
    }
  });
}

// request schedule script
if (document.querySelector("#patient-requests-form")) {
  const form = document.querySelector("#patient-requests-form");
  const acceptBtns = [...form.querySelectorAll(".accept-btn")];
  acceptBtns.forEach((btn) => {
    const value = btn.value;
    btn.addEventListener("click", () => {
      Swal.fire({
        title: "Accept Confirmation",
        text: `Do you want to accept this appointment?`,
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,
        cancelButtonColor: NO_CONFIRM_BTN_COLOR,
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.isConfirmed) {
          const input = document.createElement("input");
          input.setAttribute("name", "completed");
          input.setAttribute("value", value);
          input.setAttribute("type", "hidden");
          form.append(input);
          form.submit();
        }
      });
    });
  });

  const declinedBtns = [...form.querySelectorAll(".decline-btn")];
  declinedBtns.forEach((btn) => {
    const value = btn.value;

    btn.addEventListener("click", () => {
      Swal.fire({
        title: "Decline Confirmation",
        text: `Do you want to decline this appointments`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,
        cancelButtonColor: NO_CONFIRM_BTN_COLOR,
        confirmButtonText: "Yes",
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire({
            title: "Declining Reason",
            icon: "info",
            input: "text",
            inputAttributes: {
              autocapitalize: "off",
            },
            showCancelButton: true,
            confirmButtonColor: YES_CONFIRM_BTN_COLOR,
            confirmButtonText: "Send",
            showLoaderOnConfirm: true,
            preConfirm: (declineText) => {
              if (declineText.trim().length === 0) {
                Swal.fire({
                  title: "Error",
                  icon: "error",
                  text: "Decline reason must not be empty",
                  confirmButtonColor: YES_CONFIRM_BTN_COLOR,
                });
                return false;
              }
              const declinedInput = document.createElement("input");
              declinedInput.setAttribute("name", "missed");
              declinedInput.setAttribute("value", value);
              declinedInput.setAttribute("type", "hidden");
              form.append(declinedInput);

              const input = document.createElement("input");
              input.setAttribute("name", "declineReason");
              input.setAttribute("value", declineText);
              input.setAttribute("type", "hidden");
              form.append(input);
            },
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        }
      });
    });
  });

  form.addEventListener("submit", (e) => {
    e.preventDefault();
  });
}

// Signout modal
if (document.querySelector("#signout-btn")) {
  const logoutBtn = document.querySelector("#signout-btn");

  logoutBtn.addEventListener("click", () => {
    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: YES_CONFIRM_BTN_COLOR,
      cancelButtonColor: NO_CONFIRM_BTN_COLOR,
      confirmButtonText: "Yes",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "../php/logout.php";
      }
    });
  });
}

// Employee page
// Add new Employee logic
if (document.querySelector("#add-employee-btn")) {
  document.querySelector("#add-employee-btn").addEventListener("click", () => {
    Swal.fire({
      icon: "question",
      title: "Add a new employee",
      html: `
      <form method="post" action="employees.php">
        <label> Enter the new employee's email. Must have an existing account!</label> 
         <input type='hidden' value='add' name='type'/>
         <input type="email" required name="email" id="add-email" class="swal2-input" placeholder="Enter Email">
      </form> 
      `,
      inputAttributes: {
        autocapitalize: "off",
      },
      showCancelButton: true,
      confirmButtonText: "Add Employee",
      confirmButtonColor: YES_CONFIRM_BTN_COLOR,

      preConfirm: () => {
        const form = Swal.getPopup().querySelector("form");
        const email = Swal.getPopup().querySelector("#add-email");
        if (!email.value || !email.validity.valid) {
          Swal.showValidationMessage(`Please enter proper email!`);
        } else {
          form.submit();
        }
      },
    });
  });
}

// Delete an Employee logic
if (document.querySelector("#remove-employee-btn")) {
  document
    .querySelector("#remove-employee-btn")
    .addEventListener("click", () => {
      Swal.fire({
        icon: "warning",
        title: "Remove an employee",
        html: `
      <form method="post" action="employees.php">
        <label>Please enter the email of the employee</label> 
         <input type='hidden' value='remove' name='type'/>
         <input type="email" name="email" required id="remove-email" class="swal2-input" placeholder="Enter Email">
      </form> 
      `,
        inputAttributes: {
          autocapitalize: "off",
        },
        showCancelButton: true,
        confirmButtonText: "Remove Employee",
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,

        preConfirm: () => {
          const form = Swal.getPopup().querySelector("form");
          const email = Swal.getPopup().querySelector("#remove-email");
          if (!email.value || !email.validity.valid) {
            Swal.showValidationMessage(`Please enter proper email!`);
          } else {
            form.submit();
          }
        },
      });
    });
}
const getTodayDate = () => {
  const now = new Date();
  const day = ("0" + now.getDate()).slice(-2);
  const month = ("0" + (now.getMonth() + 1)).slice(-2);

  return now.getFullYear() + "-" + month + "-" + day;
};

// Records Logic
if (document.querySelector("#search-record-form")) {
  console.log("first");
  const form = document.querySelector("#search-record-form");
  const select = form.querySelector("#filter-select");

  const insertedNode = document.createElement("div");
  insertedNode.classList.add("insertedNode");
  insertedNode.innerHTML = `
  <input type="date" id="dateFilter" name="dateFilter" value='${getTodayDate()}'>
  `;
  form.insertBefore(insertedNode, form.children[1]);

  select.addEventListener("change", (e) => {
    const val = e.target.value;
    let element = "";
    if (val === "date") {
      element = `
      <input type="date" id="dateFilter" name="dateFilter" value='${getTodayDate()}'>
      `;
    } else if (val === "state") {
      element = `
      <select name="stateFilters" id="stateFilters">
      <option value="selectState"  disabled>Select a State</option>
      <option selected value="completed">Completed</option>
      <option value="pending">Pending</option>
      <option value="declined">Declined</option>
      <option value="accepted">Accepted</option>
      <option value="cancelled">Cancelled</option>
       </select>

      `;
    } else if (val === "branch") {
      element = `
      <select name="stateFilters" id="stateFilters">
      <option value="selectState"  disabled>Select a Branch</option>
      <option value="s_simon" selected>San Simon</option>
      <option value="mexico">Mexico</option>

       </select>

      `;
    } else if (val === "service") {
      element = `
      <select name="serviceFilters" id="serviceFilters">
      <option value="selectService"  disabled>Select a Service</option>
      <option value="clean" selected>Oral Prophylaxis</option>
      <option value="d_crown">Dental Crown</option>
      <option value="pasta">Dental Fillings</option>
      <option value="wisdom">Wisdom Tooth Extraction</option>
  </select>
      `;
    } else {
      element = `
      <input type="email" placeholder="email" name="emailFilter" id="emailFilter" required>
      `;
    }
    // clears all the content
    insertedNode.replaceChildren();
    // inserts new content
    insertedNode.innerHTML = element;
  });
}

// tab highlighting
(() => {
  // works by comparing last url name to last link url
  const sidebarLinks = [...document.querySelectorAll(".options-bar a")];
  const pageName = window.location.href.split("/").pop();
  const activeTab = sidebarLinks.find((a) => {
    return pageName.includes(a.href.split("/").pop());
  });
  activeTab.classList.add("active");
})();

if (document.querySelector(".show-note-btn")) {
  const btns = [...document.querySelectorAll(".show-note-btn")];
  btns.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      Swal.fire({
        title: "Note",
        text: btn.dataset.noteValue,
        icon: "info",
        confirmButtonColor: YES_CONFIRM_BTN_COLOR,
        cancelButtonColor: NO_CONFIRM_BTN_COLOR,
      });
    });
  });
}

// input validation

if (
  document.querySelector("#inputConfirmNewPassword") &&
  document.querySelector("#inputNewPassword")
) {
  const form = document.querySelector("#changePassForm");

  const newPass = document.querySelector("#inputNewPassword");
  const newPassNotif = document.querySelector(
    "#inputNewPassword+.input-notif-msg"
  );
  const confirmPass = document.querySelector("#inputConfirmNewPassword");
  const confirmPassNotif = document.querySelector(
    "#inputConfirmNewPassword+.input-notif-msg"
  );
  const currentPass = document.querySelector("#inputCurrentPassword");
  const currentPassNotif = document.querySelector(
    "#inputCurrentPassword+.input-notif-msg"
  );

  const passwordMsg =
    "X Must contain at least 8 characters with number and uppercase";

  const submitBtn = form.querySelector(".submit-btn");
  const isAllValid = () =>
    newPass.validity.valid &&
    confirmPass.validity.valid &&
    currentPass.validity.valid &&
    confirmPass.value === newPass.value;

  const toggleSubmitBtn = () => {
    if (isAllValid()) {
      submitBtn.classList.remove("disabled-btn");
      submitBtn.disabled = false;
    } else {
      submitBtn.classList.add("disabled-btn");
      submitBtn.disabled = true;
    }
  };
  newPass.addEventListener("input", (e) => {
    if (!newPass.validity.valid) {
      newPassNotif.textContent = passwordMsg;
    } else {
      newPassNotif.textContent = "";
    }
    toggleSubmitBtn();
  });

  confirmPass.addEventListener("input", (e) => {
    if (!confirmPass.validity.valid) {
      confirmPassNotif.textContent = passwordMsg;
      return;
    } else {
      confirmPassNotif.textContent = "";
    }

    if (confirmPass.value === newPass.value) {
      // confirmPassNotif.textContent = "✔ Passwords Matched!";
      confirmPassNotif.textContent = "";
      confirmPass.validity.valid = true;
    } else {
      confirmPassNotif.textContent = "X Passwords don't match";
      confirmPass.validity.valid = false;
    }
    toggleSubmitBtn();
  });

  currentPass.addEventListener("input", (e) => {
    if (!currentPass.validity.valid) {
      currentPassNotif.textContent = passwordMsg;
    } else {
      currentPassNotif.textContent = "";
    }
    toggleSubmitBtn();
  });

  const togglePassword = document.querySelector("#togglePassword");
  togglePassword.addEventListener("click", function (e) {
    const type =
      confirmPass.getAttribute("type") === "password" ? "text" : "password";
    confirmPass.setAttribute("type", type);
    currentPass.setAttribute("type", type);
    newPass.setAttribute("type", type);
  });
  const resetBtn = form.querySelector(".reset-btn");
  resetBtn.addEventListener("click", () => {
    newPassNotif.textContent = "";
    confirmPassNotif.textContent = "";
    currentPassNotif.textContent = "";
  });
}

if (document.querySelector("#inputContactNumber")) {
  const contactNum = document.querySelector("#inputContactNumber");
  const notif = document.querySelector("#inputContactNumber+.input-notif-msg");
  const submitBtn = document.querySelector("#submit-account-details-btn");

  const letters = /^\d+$/;
  contactNum.addEventListener("input", () => {
    if (contactNum.value.match(letters) && contactNum.value.length == 10) {
      notif.textContent = "";
      submitBtn.classList.remove("disabled-btn");
      submitBtn.disabled = false;
    } else {
      notif.textContent = "Please input 10 digits only.";
      contactNum.validity.valid = false;
      submitBtn.classList.add("disabled-btn");
      submitBtn.disabled = true;
    }
  });
  const cancelBtn = document.querySelector("#cancel-account-details-btn");

  cancelBtn.addEventListener("click", () => {
    notif.textContent = "";
  });
}

if (document.querySelector(".radio-container")) {
  const labels = document.querySelectorAll(".radio-container");
  labels.forEach((label) => {
    const input = label.querySelector("input");
    label.addEventListener("click", () => {
      if (input.checked) {
        labels.forEach((l) => l.classList.remove("label-checked"));
        label.classList.add("label-checked");
      }
    });
  });
}
