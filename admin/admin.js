$(document).ready(function () {
    $("#difficultySelect").change(function () {
        loadLevels();
        changeLevel();
    })

    $("#levelSelect").change(function () {
        changeLevel();
    })

    $("#save-button").click(function () {
        var difficulty = document.getElementById("difficultySelect").value.trim();
        var level = document.getElementById("levelSelect").value.trim();
        var question = document.getElementById("question").value.trim();
        var choice1 = document.getElementById("choice1").value.trim();
        var choice2 = document.getElementById("choice2").value.trim();
        var choice3 = document.getElementById("choice3").value.trim();
        var choice4 = document.getElementById("choice4").value.trim();
        var correct = document.querySelector('input[name="correct"]:checked');


        if (!difficulty || !level || !question || !choice1 || !choice2 || !choice3 || !choice4 || !correct) {
            Swal.fire({
                icon: "error",
                title: "Missing Fields!",
                text: "Make sure to enter all the fields to add!"
            });
        }
        else {
            var correctAns = correct.value;
            Swal.fire({
                title: "Save Changes?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes!"
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "ajax.php?action=addQuestion";
                    var confirm = "Question Added!";
                    if (level != 0) {
                        url = "ajax.php?action=editQuestion";
                        confirm = "Question Edited!";
                    }
                    Swal.fire(confirm, "", "success").then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    difficulty: difficulty,
                                    level: level,
                                    question: question,
                                    choice1: choice1,
                                    choice2: choice2,
                                    choice3: choice3,
                                    choice4: choice4,
                                    correct: correctAns
                                },
                                dataType: 'json',
                                success: function () {
                                    window.location.href = "admin.php";
                                },
                                error: function (xhr, status, error) {
                                    console.error("An error occurred: " + error);
                                    console.log("Response text: " + xhr.responseText);
                                }
                            });
                        }
                    });
                }
            });
        }
    })
});


function loadLevelsSelect(levels) {
    var levelCount = 0;
    for (var i = 0; i < levels.length; i++) {
        var option = document.createElement("option");
        option.text = "Level " + levels[i].level;
        option.value = levels[i].id;
        levelSelect.add(option);
        levelCount++;
    }
    var option = document.createElement("option");
    option.text = "Add new Level (Level " + parseInt(levelCount + 1) + ")";
    option.value = 0;
    levelSelect.add(option);
}


function loadLevels() {
    var levelSelect = document.getElementById('levelSelect');
    var difficulty = document.getElementById('difficultySelect').value;

    removeOptions(levelSelect);
    var option = document.createElement("option");
    option.text = "Select a Level";
    option.value = "";
    levelSelect.add(option);
    $.ajax({
        type: "POST",
        url: "ajax.php?action=getLevels",
        data: { difficulty: difficulty },
        dataType: 'json',
        success: function (response) {
            loadLevelsSelect(response)
            //   console.log(categories);
        },
        error: function (xhr, status, error) {
            console.error("An error occurred: " + error);
            console.log("Response text: " + xhr.responseText);
        }
    });

}

function changeLevel() {
    var questionID = parseInt(document.getElementById("levelSelect").value);
    if (!isNaN(questionID) && questionID > 0) {
        $.ajax({
            type: "POST",
            url: "ajax.php?action=getLevelDetails",
            data: { questionID: questionID },
            dataType: 'json',
            success: function (response) {
                document.getElementById("question").value = response.question;
                document.getElementById("choice1").value = response.choice1;
                document.getElementById("choice2").value = response.choice2;
                document.getElementById("choice3").value = response.choice3;
                document.getElementById("choice4").value = response.choice4;
                if (response.correct == "1") {
                    document.getElementById("choice1c").checked = true;
                }
                else if (response.correct == "2") {
                    document.getElementById("choice2c").checked = true;
                }
                else if (response.correct == "3") {
                    document.getElementById("choice3c").checked = true;
                }
                else if (response.correct == "4") {
                    document.getElementById("choice4c").checked = true;
                }
            },
            error: function (xhr, status, error) {
                console.error("An error occurred: " + error);
                console.log("Response text: " + xhr.responseText);
            }
        });
    }
    else {
        document.getElementById("question").value = "";
        document.getElementById("choice1").value = "";
        document.getElementById("choice2").value = "";
        document.getElementById("choice3").value = "";
        document.getElementById("choice4").value = "";
        document.getElementById("choice1c").checked = false;
        document.getElementById("choice2c").checked = false;
        document.getElementById("choice3c").checked = false;
        document.getElementById("choice4c").checked = false;
    }
}

function removeOptions(selectElement) {
    var i, L = selectElement.options.length - 1;
    for (i = L; i >= 0; i--) {
        selectElement.remove(i);
    }
}