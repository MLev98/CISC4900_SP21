var origin = null;
$(document).ready(function () {
    $(".sortable").sortable({
        placeholder: 'ui-state-highlight',
        items: '.qitem',
        connectWith: ".sortable",
        dropOnEmpty: true,
        revert: 'invalid',
        start:function(event, ui){
            if(ui.item[0].classList[0] === "tmp") {
                origin = -1;
            } else {
                origin = ui.item.offsetParent()[0].id;
            }
        },
        stop: function (event, ui) {
            if(ui.item[0].classList[0] === "tmp") document.getElementById(ui.item.attr("id")).classList.remove("tmp");

            end = ui.item.offsetParent()[0].id;

            if(origin != end) sendDrop(end, ui.item[0].id);
        }
    });

});
/*
    Updates database when course is dropped into a semester
    @params:
    semester - column id where item is dropped
    classID - item id from course that was dragged
*/
function sendDrop(semester, classID) {
    var semester_title = document.getElementById("h5" + semester).innerText;
    var semester_credits = semester_title.substring(
        semester_title.lastIndexOf("(") + 1,
        semester_title.lastIndexOf(")")
    );

    if (semester_credits < 19) {
        $.ajax({
            url: 'dashboard.php',
            data: {
                dropClass: true,
                groupID: semester,
                courseID: classID
            },
            type: 'POST',
            success: function (output) {
                successfully_added_course_notification();
            }
        });
    } else {
        unsuccessfully_added_course_notification();
    }
}

/*
    Updates database when delete button is clicked
    
    @params:
    classID - item id from button's parent course
*/
function removeClass(classID) {
    $.ajax({
        url: 'dashboard.php',
        data: {
            deleteClass: "true",
            courseID: classID
        },
        type: 'POST',
        success: function (output) {
            successfully_delete_course_notification();
        }
    });
}

/*
    Creates html for draggable course element
*/
function createClass() {
    if (document.getElementById("temp-row")) {
        document.getElementById("temp-row").remove();
    }

    var e = document.getElementById("addCourseF");
    var classID = e.value;
    if(classID === "") {
        no_dept_class_selected();
        return;
    }
    var arr = e.options[e.selectedIndex].text.split(" | ");
    var classCode = arr[0];
    var className = arr[1];

    var node0 = document.createElement("div");
    var node1 = document.createElement("div");
    var node2 = document.createElement("div");
    var node3 = document.createElement("div");
    var node4 = document.createElement("h4");
    var node5 = document.createElement("p");

    node5.innerHTML = className;
    node4.innerHTML = classCode;

    node0.className = "row sortable temp-row";
    node1.className = "tmp col-lg-12 col-xl-12 qitem";
    node2.className = "card-sub";
    node3.className = "card-block class-block";
    node4.className = "card-title";
    node5.className = "card-text";

    node0.setAttribute("id", "temp-row");
    node1.setAttribute("id", "c" + classID);

    node3.append(node4);
    node3.append(node5);
    node2.append(node3);
    node1.append(node2);
    node0.append(node1);

    document.getElementById("listofcard").appendChild(node0);
    $('.qitem').draggable({
        connectToSortable: ".sortable"
    });
}

/*
    Creates html for sortable semester element
*/
function createSemester() {
    var all_cards = Array.from(document.querySelectorAll('.card'));
    var newest_card = 1;
    var formCount = 1;

    /*
        Determines the correct # semester element to create.
        Otherwise we would need to update database when an entire semester element is deleted
        e.g {Semester 1,2,3} if we delete {Semester 2} then we would have {Semester 1,3} the next semester should be 4
        but instead would create 3 again, corrupting the database.
    */
    if (all_cards.length != 0) {
        newest_card = all_cards.reduce((p, c) => p.id > c.id ? p : c);
        formCount = parseInt(newest_card.id) + 1;
    }

    var node0 = document.createElement("div");
    var node1 = document.createElement("div");
    var node2 = document.createElement("div");
    var node3 = document.createElement("h5");

    var node4 = document.createElement("div");
    var node5 = document.createElement("div");

    node3.innerHTML = "Semester " + formCount;

    node0.className = "col-3 col-cards d-flex"
    node1.className = "card";
    node2.className = "card-header";

    node4.className = "card-block main-block";
    node5.className = "row sortable";

    node1.setAttribute("id", formCount);
    node3.setAttribute("id", "h5" + formCount);

    node2.append(node3);
    node1.append(node2);
    node0.append(node1);

    node4.append(node5);
    node1.append(node4);

    document.getElementById("listofcard").appendChild(node0);
    var newdiv = document.createElement("div");

    document.getElementById(formCount).appendChild(newdiv);

    $(".sortable").sortable({
        connectToSortable: ".sortable",
        stop: function (event, ui) {
            sendDrop(ui.item.offsetParent()[0].id, ui.item[0].id);
        }
    });
}