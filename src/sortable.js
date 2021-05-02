$(document).ready(function () {
    $(".sortable").sortable({
        placeholder: 'ui-state-highlight',
        items: '.qitem',
        connectWith: ".sortable",
        dropOnEmpty: true,
        stop: function(event, ui){
            sendDrop(ui.item.offsetParent()[0].id, ui.item[0].id);
            //UPDATE THIS in DB
        }
    });
    $(".sortable").disableSelection();
});

function sendDrop(semester, classID) {

    console.log("semester: " + semester);
    console.log("class id: " + classID);
    $.ajax({ url: 'dashboard.php',
         data: {
             groupID: semester,
             courseID: classID
            },
         type: 'POST',
         success: function(output) {
            location.reload();
                  }
});
}

function addCreateForm(divId, formName) {
    var formCount = document.forms.length;
    var oForm = document.forms[formName];
    var clone = oForm.cloneNode(true);
    clone.name += "_" + formCount;
    clone.style.display = "block";
    
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "groupID");
    input.setAttribute("value", divId);
    clone.appendChild(input);
    document.getElementById(divId).appendChild(clone);
}

function createSemester(formName) {
    var formCount = document.forms.length-1;
  
    var node1 = document.createElement("div");
    var node2 = document.createElement("div");
    var node3 = document.createElement("div");
    var node4 = document.createElement("div");
    var node5 = document.createElement("h5");
    node5.innerHTML = "Semester " + formCount;
  
    node1.className = "row container d-flex justify-content-center";
    node2.className = "col-sm-12";
    node3.className = "card";
    node4.className = "card-header";
  
    node3.setAttribute("id", formCount);
    node5.setAttribute("id", "h5"+formCount);
  
    node4.append(node5);
    node3.append(node4);
    node2.append(node3);
    node1.append(node2);
  
    document.getElementById("container").appendChild(node1);
    document.getElementById("container").appendChild(createForm(formName));
  }
  
  function createForm(formName) {
      var formCount = document.forms.length-1;
      var oForm = document.forms[formName];
      var clone = oForm.cloneNode(true);
      clone.name += "_" + formCount;
      clone.style.display = "block";
  
      var input = document.createElement("input");
      input.setAttribute("type", "hidden");
      input.setAttribute("name", "groupID");
      input.setAttribute("value", formCount );
      clone.appendChild(input);
  
      return clone;
  }

function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}