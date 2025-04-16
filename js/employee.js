let employeeModal;

document.addEventListener('DOMContentLoaded', function () {
  employeeModal = new bootstrap.Modal(document.getElementById('employeeModal'));
  loadEmployees();
});

function showModal(id = '', name = '') {
  document.getElementById('uploadForm').reset();
  document.getElementById('empId').value = id;
  document.getElementById('empName').value = name;
  employeeModal.show();
}

function hideModal() {
  employeeModal.hide();
}

document.getElementById('uploadForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const formData = new FormData(this);
  fetch("save_employee.php", {method: 'POST', body: formData}).then((result)=>{
    return result.json()
  }).then((data)=>{
    if(data.success) {
        hideModal();
        loadEmployees();
    }
    alert(data.message);
  })
  .catch(err=>{
    alert(err.message);
  })
});

function loadEmployees() {
  fetch('fetch.php').then((response)=>{
    return response.text();
  }).then((data)=>{
    document.getElementById('employeeTable').innerHTML= data;
  }).catch(err=>{
    alert(err.message);
  })
}

function deleteEmployee(id) {
  if (confirm("Are you sure?")) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "delete.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onload = function () {
      alert(this.responseText);
      loadEmployees();
    };
    xhr.send("id=" + encodeURIComponent(id));
  }
}

function previewEmployee(id) {
  window.open('generate_pdf.php?id=' + id, '_blank');
}