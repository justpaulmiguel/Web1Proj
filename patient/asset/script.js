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

// Signout modal
if (document.querySelector("#signout-btn")) {
  const logoutBtn = document.querySelector("#signout-btn");

  logoutBtn.addEventListener("click", () => {
    Swal.fire({
      title: "Are you sure?",
      text: "You will be logged out!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "../php/logout.php";
      }
    });
  });
}

// tab highlighting
(() => {
  // works by comparing last url name to last link url
  const sidebarLinks = [...document.querySelectorAll(".options-bar a")];
  const pageName = window.location.href.split("/").pop();

  const activeTab = sidebarLinks.find((a) => {
    const linkName = a.href.split("/").pop();
    if (pageName.includes("book") && linkName.includes("book")) return true;
    return linkName === pageName;
  });
  activeTab.classList.add("active");
})();

// show note btn functionality
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

// Cancel Booking
function cancelBook() {
  Swal.fire({
    title: "Are you sure?",
    text: "Do you want to cancel this booking?",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = "asset/cancel_booking.php";
    }
  });
}
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
      }).then((result) => {
        if (result.isConfirmed) {
          formDOM.submit();
        }
      });
    }
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
