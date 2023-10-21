// === FUNGSI CEKBOK ALL ===
// Function to handle header checkbox click
function handleHeaderCheckboxClick(checkbox) {
  var isChecked = checkbox.checked;

  // Select all task checkboxes
  var taskCheckboxes = document.querySelectorAll(
    'input[type="checkbox"][name="done"]'
  );

  // Set the checked property of all task checkboxes to match the header checkbox
  taskCheckboxes.forEach(function (taskCheckbox) {
    taskCheckbox.checked = isChecked;

    // Trigger the change event on each task checkbox to update their status
    var event = new Event("change");
    taskCheckbox.dispatchEvent(event);
  });
}

// Attach event handler to the header checkbox
var headerCheckbox = document.getElementById("headerCheckbox");
headerCheckbox.addEventListener("change", function () {
  handleHeaderCheckboxClick(headerCheckbox);
});

// === FUNGSI CHECKBOX KLIK TURUN ===
// Function checkbox click
function handleCheckboxClick(checkbox) {
  var taskID = checkbox.getAttribute("data-task-id");
  var isChecked = checkbox.checked ? 1 : 0;
  if (isChecked) {
    // Move the checked task to the bottom of the table
    var taskRow = checkbox.closest(".task-row");
    var table = taskRow.parentElement;
    table.appendChild(taskRow);
  }
  // AJAX request ke update_task.php
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "update_task.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("task_id=" + taskID + "&task_done=" + isChecked);
}

// Function select change
function handleSelectChange(select) {
  var taskID = select.getAttribute("data-task-id");
  var progress = select.value;

  // AJAX request ke update_task_progress.php
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "update_task_progress.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("task_id=" + taskID + "&progress=" + progress);
}

// Attach event handlers to checkboxes and select elements
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var selects = document.querySelectorAll('select[name="progress"]');

checkboxes.forEach(function (checkbox) {
  checkbox.onclick = function () {
    handleCheckboxClick(checkbox);
  };
});

selects.forEach(function (select) {
  select.onchange = function () {
    handleSelectChange(select);
  };
});

// Attach event handlers to checkboxes
var checkboxes = document.querySelectorAll('input[type="checkbox"]');
checkboxes.forEach(function (checkbox) {
  checkbox.addEventListener("change", function () {
    handleCheckboxClick(checkbox);
  });
});

// === EDIT FUNCTIONS ===
document.addEventListener("DOMContentLoaded", function () {
  const editLinks = document.querySelectorAll(".edit-link");
  editLinks.forEach(function (editLink) {
    editLink.addEventListener("click", function (event) {
      event.preventDefault();
      const taskRow = event.target.closest(".task-row");
      if (taskRow) {
        const taskID = taskRow.getAttribute("data-task-id");
        const taskNameElement = taskRow.querySelector(".task-name");
        const deskripsiElement = taskRow.querySelector(".deskripsi");
        const tanggalElement = taskRow.querySelector(".tanggal");

        if (taskNameElement.contentEditable !== "true") {
          // Change the link's content to "Save" and update the icon
          event.target.innerHTML = `
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-square" viewBox="0 0 16 16">
          <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
          <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
          </svg> Save`;

          // Toggle the contentEditable attribute for task name and deskripsi fields
          taskNameElement.contentEditable = "true";
          deskripsiElement.contentEditable = "true";

          // Change the tanggal field to an input type date with the previous value
          const previousTanggal = tanggalElement.textContent;
          tanggalElement.innerHTML = `<input type="date" class="form-control" id="edit-tanggal-${taskID}" value="${previousTanggal}">`;
        } else {
          // Save button clicked, send an AJAX request to update the data
          const updatedTaskData = {
            taskID: taskID,
            taskName: taskNameElement.textContent,
            deskripsi: deskripsiElement.textContent,
            tanggal: document.getElementById(`edit-tanggal-${taskID}`).value,
          };

          // Send an AJAX POST request
          fetch("edit_task.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(updatedTaskData),
          })
            .then((response) => response.json())
            .then((data) => {
              if (data.success) {
                // Update was successful, change the link's content back to "Edit" and update the icon
                event.target.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106a.5.5 0 0 1 .325-.468V12h.5a.5.5 0 0 1 .5.5V12h.5a.5.5 0 0 1 .5.5V11h.5a.5.5 0 0 1 .325.468z" />
                </svg> Edit`;

                // Toggle the contentEditable attribute for task name and deskripsi fields
                taskNameElement.contentEditable = "false";
                deskripsiElement.contentEditable = "false";

                // Restore the original tanggal format
                const dateValue = new Date(updatedTaskData.tanggal);
                const formattedDate = dateValue.toLocaleDateString("en-GB", {
                  day: "numeric",
                  month: "long",
                  year: "numeric",
                });
                tanggalElement.textContent = formattedDate;
              }
            })
            .catch((error) => {
              console.error("Error:", error);
              // Handle the error
            });
        }
      }
    });
  });
});
