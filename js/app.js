// When user clicks '+' button add a new textarea/input element containing the text in the existing text area.
// Add the new textarea/input immediately before 

// create an array of all the '+' buttons
var addButtons = document.getElementsByClassName("add_new");

var createNewUpdateElement = function (updateString) {
  //console.log('Add button clicked');
// Create new elements to be added
  var containerLabel = document.createElement("label");
  var textArea = document.createElement("textarea");
// Add relevant attribute details
  containerLabel.className = "textarea textarea-expandable";
  textArea.setAttribute("rows", "3");
// Get the name of the textArea as this will be used to form the name & id of the new textarea(s).
// Not the prettiest code but we know the original textarea will always be in this position
  var textAreaName = this.parentNode.firstChild.nextSibling.nextSibling.firstChild.id + this.parentNode.firstChild.innerText;
  textArea.name = textAreaName;
  textArea.id = textAreaName;
// Add the textarea to the label and then the label to the div
  containerLabel.appendChild(textArea);
  this.parentNode.insertBefore(containerLabel, this);
// Increment the number in the counter label
  var counterVal = Number(this.parentNode.firstChild.innerText);
  counterVal += 1;
  this.parentNode.firstChild.innerText = counterVal;
// If counterVal is 2 add functionality and a class to the '-' button
  if (counterVal == 2) {
    this.nextSibling.onclick = deleteLastUpdateElement;
    this.nextSibling.setAttribute("class", "delete_new");
  }
}

var deleteLastUpdateElement = function () {
// delete the last newly added element, don't delete if counter is 1
  //console.log('Delete button clicked');
// get the value of the counter label
  var counterVal = Number(this.parentNode.firstChild.innerText);
// if it's currently greater than 1
  if (counterVal > 1) {
  // decrement the counter in the hidden label
    counterVal = counterVal - 1;
    this.parentNode.firstChild.innerText = counterVal;
  // delete the textarea
    this.parentNode.removeChild(this.previousSibling.previousSibling);
  // if the counterVal is now 1, remove the className from the '-' button and disable it's functionality
    if (counterVal < 2) {
      this.onclick = "";
      this.removeAttribute("class");
    }
  }
}

var testTest = function () {
  // var val = this.parentNode.parentNode.className;
  // var val = this.parentNode.firstChild.innerText;
  var val = this.parentNode.firstChild.nextSibling.nextSibling.firstChild.id;
  alert(val);
}

function ValidateForm () {
// validate the date entered into the form.
  var valid = true;
  var error_message = "";
  var dateStr = document.getElementById("date").value

// It must not be blank
  if (dateStr == "") {    
    valid = false;
    error_message = "You haven't chosen a date";
  } else {
  // format the date string to something parseable
    var newDateStr = dateStr.replace(/(\d+)\.(\d+)\.(\d+)/, "$3 $2 $1");
    var dateVal = new Date(newDateStr);
  // it must not be more than six days in the future
  // set a future date (seven days in the future)
    var fDate = new Date();
    fDate.setDate(fDate.getDate() + 7);
  // set a past date (two months in the past)
    var pDate = new Date();
    pDate.setMonth(pDate.getMonth() - 2);
  // perform checks
    if (dateVal > fDate) {
      valid = false;
      error_message = "You must be a visionary, looking that far into the future";
    } else if (dateVal < pDate) {
      valid = false;
      error_message = "That's ancient history, no use raking over old ground";
    } else if (dateVal.getDay() != 1) {
      valid = false;
      error_message = "Weeks begin on a Monday around here, chump";
    }
  }   // end if (dateStr == "") {
  
  if (error_message != "") {
  // log the message
    console.log(error_message);
  // and show it on the screen (css already prepared)
    /*var err_msg_section = document.createElement("section");
    var err_msg_div = document.createElement("div");
  // add class details
    err_msg_section.className = "col";
    err_msg_div.className = "err_msg";
  // add innerText
    err_msg_div.innerText = error_message;
  // put the div inside the section
    err_msg_section.appendChild(err_msg_div);
  // append the section inside the date area*/


  // add the relevant class to the date input
    var date_pick = document.getElementsByName("date");
    date_pick[0].parentNode.className += " state-error";
    date_pick[0].className += " invalid";
  // show the error message
    var date_err_msg = document.getElementById("date_err_msg");
    date_err_msg.innerText = error_message;
    date_err_msg.style.display = "block";
  }

  return valid;
}   // end function ValidateForm () {

// bind create element function to buttons
for (var i=0; i<addButtons.length; i++) {
  addButtons[i].onclick = createNewUpdateElement;
}
