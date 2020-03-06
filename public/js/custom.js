//Admin Delete User
function deleteUser(id) {
    console.log(id);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: "/admins/" + id,
        type: "DELETE",
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-success alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.success + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;
            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

//Delete Department function
function deleteDepartment(id) {
    console.log(id);
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    $.ajax({
        url: "/departments/" + id,
        type: "DELETE",
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-success alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.success + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;
            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

//Task form submit
$("#tasksform").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    let tasks = [];
    $("input:checkbox[name=tasks]:checked").each(function() {
        tasks.push(
            $(this)
                .val(this.id)
                .val()
        );
    });
    console.log(tasks);
    $.post("/update", { tasks }, function(data) {
        let alertDivStart =
            "<div class='alert alert-success alert-block mt-2'>";
        let alertBtn =
            "<button type='button' class='close' data-dismiss='alert'>×</button>";
        let alertMsg = "<strong>" + data.success + "</strong>";
        let alertDivEnd = "</div>";

        let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;
        $("#cont").prepend(divElement);
    });
});

//Edit Users In Project Btn Click
$(".editUsersInProjectBtn").click(function(e) {
    let pid = $(this).attr("id");
    let hiddenEl =
        "<input type='hidden' name='projects_id' value=" + pid + " disabled>";
    $("#submitBtnDiv").prepend(hiddenEl);

    let userIds = $(this).data("ids");
    let username = $(this).data("username");

    let uids = JSON.parse("[" + userIds + "]");
    let uname = username.split(",");

    let optionEl = "";
    $("#select2")
        .find("option")
        .each(function() {
            $(this).remove();
        });

    $.ajax({
        url: "/projectUser/" + pid + "/edit",
        type: "GET",
        success: function(data) {
            for (let i = 0; i < data.length; i++) {
                if (uids[i] == data[i].userId && uname[i] == data[i].username) {
                    optionEl =
                        "<option selected value='" +
                        uids[i] +
                        "'>" +
                        uname[i] +
                        "</option>";
                    $("#select2").append(optionEl);
                } else {
                    optionEl =
                        "<option value='" +
                        data[i].userId +
                        "'>" +
                        data[i].username +
                        "</option>";
                    $("#select2").append(optionEl);
                }
            }
        }
    });
    $("#editUsersInProject").modal("show");
});

//Edit Users in project form
$("#editUsersInProjectForm").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    let projectId = $(this)
        .find(":hidden")
        .val();

    let userIds = $(this)
        .find("#select2")
        .val();
    console.log(userIds);

    $.ajax({
        url: "/projectUser/" + projectId,
        type: "PATCH",
        data: { userIds },
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-info alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.info + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

            $(".modal").modal("hide");
            $("#cont").prepend(divElement);
            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    });
});

//Remove User From Project
$(".remBtn").click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    let userId = $("#user")
        .find(":selected")
        .val();

    $.ajax({
        url: "/projectUser/" + userId,
        data: $("#editUsersInProjectForm").serialize(),
        type: "DELETE",
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-info alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.info + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

            $(".modal").modal("hide");
            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(data) {
            console.log(data);
        }
    });
});

//Projects Edit Form JS
$("#editform").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
    let projectId = $(".editBtn").attr("id");
    $.ajax({
        url: "/projects/" + projectId,
        type: "PATCH",
        data: $(this).serialize(),
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-info alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.info + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

            $(".modal").modal("hide");
            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        }
    });
});

//New Status Form
$("#newStatusForm").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $.post("/status", $(this).serialize(), function(data) {
        let alertDivStart = "<div class='alert alert-info alert-block mt-2'>";
        let alertBtn =
            "<button type='button' class='close' data-dismiss='alert'>×</button>";
        let alertMsg = "<strong>" + data.info + "</strong>";
        let alertDivEnd = "</div>";

        let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

        $(".modal").modal("hide");
        $("#cont").prepend(divElement);
        setTimeout(function() {
            location.reload();
        }, 2000);
    });
});

//Edit Status Button Click Button
$(".editStatusBtn").click(function() {
    let statusId = $(this).attr("id");

    let hiddenEl =
        "<input type='hidden' name='statusId' id='statusId' value=" +
        statusId +
        ">";
    $("#submitBtnDiv").prepend(hiddenEl);

    $.ajax({
        url: "/status/" + statusId + "/edit",
        type: "GET",
        success: function(data) {
            $("#editStatus").modal("show");

            $("#editStatus")
                .find(":text")
                .val(data.name);

            //background color input
            $("#editStatus")
                .find("#bgColor")
                .val(data.bgColor);

            //text color input
            $("#editStatus")
                .find("#textColor")
                .val(data.textColor);

            //radio button input
            if (data.active) {
                $("#editStatus")
                    .find("#y")
                    .prop("checked", true);
                $("#editStatus")
                    .find("#n")
                    .prop("checked", false);
            } else {
                $("#editStatus")
                    .find("#y")
                    .prop("checked", false);
                $("#editStatus")
                    .find("#n")
                    .prop("checked", true);
            }
        }
    });
});

//Edit Status Form Submit
$("#editStatusForm").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    let statusId = $(this)
        .find(":hidden")
        .val();

    $.ajax({
        url: "/status/" + statusId,
        type: "PATCH",
        data: $(this).serialize(),
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-info alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.info + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

            $(".modal").modal("hide");
            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(data) {
            console.log(data);
        }
    });
});

//Remove Status Button Click
$(".remStatusBtn").click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    let statusId = $(this).attr("id");

    $.ajax({
        url: "/status/" + statusId,
        type: "DELETE",
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-info alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.info + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

            $(".modal").modal("hide");
            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(data) {
            console.log(data);
        }
    });
});

//New Task Form Submit
$("#newTaskForm").submit(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    let projectId = $(this)
        .find(":hidden[name=projects_id]")
        .val();

    console.log($(this).serialize());

    $.post("/projects/" + projectId + "/tasks", $(this).serialize(), function(
        data
    ) {
        let alertDivStart = "<div class='alert alert-info alert-block mt-2'>";
        let alertBtn =
            "<button type='button' class='close' data-dismiss='alert'>×</button>";
        let alertMsg = "<strong>" + data.info + "</strong>";
        let alertDivEnd = "</div>";

        let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

        $(".modal").modal("hide");
        $("#cont").prepend(divElement);
        setTimeout(function() {
            location.reload();
        }, 2000);
    });
});

//Remove Task Button Click
$(".remTaskBtn").click(function(e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    let taskId = $(this).attr("id");

    $.ajax({
        url: "/tasks/" + taskId,
        type: "DELETE",
        success: function(data) {
            let alertDivStart =
                "<div class='alert alert-info alert-block mt-2'>";
            let alertBtn =
                "<button type='button' class='close' data-dismiss='alert'>×</button>";
            let alertMsg = "<strong>" + data.info + "</strong>";
            let alertDivEnd = "</div>";

            let divElement = alertDivStart + alertBtn + alertMsg + alertDivEnd;

            $("#cont").prepend(divElement);

            setTimeout(function() {
                location.reload();
            }, 2000);
        },
        error: function(data) {
            console.log(data);
        }
    });
});
