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

/**
 * Gets the elements related to modal and add display logic
 */
(() => {
  const modal = document.getElementById("myModal");

  const btn = document.getElementById("signout-btn");

  // elements that closes the modal
  const span = document.querySelector(".close-icon");
  const noBtn = document.querySelector(".modal-no-btn");

  btn.onclick = () => {
    modal.style.display = "block";
  };
  span.onclick = () => {
    modal.style.display = "none";
  };
  noBtn.onclick = () => {
    modal.style.display = "none";
  };
  window.onclick = (event) => {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
})();

// Account Details logic
// saves the values of the input first before editing.
if (document.querySelector("#edit-account-form")) {
  let fName = "";
  let lName = "";
  let contactNum = "";
  const hidden = "hidden-btn";

  const formDOM = document.querySelector("#edit-account-form");
  const editBtn = formDOM.querySelector("#btn-edit-info");
  const submitBtn = formDOM.querySelector("#submit-account-details-btn");
  const cancelBtn = formDOM.querySelector("#cancel-account-details-btn");
  const input = formDOM.querySelectorAll(".disabled-input");

  editBtn.addEventListener("click", () => {
    if (!editBtn.classList.contains(hidden)) {
      submitBtn.classList.remove(hidden);
      cancelBtn.classList.remove(hidden);
      editBtn.classList.add(hidden);
      fName = formDOM.inputFName.value;
      lName = formDOM.inputLName.value;
      contactNum = formDOM.inputContactNumber.value;
      input.forEach((element) => {
        console.log("hlloet");
        element.classList.remove("disabled-input");
        element.disabled = false;
      });
    }
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

  // todo add confirmation modal here before passing into the form dom
}
