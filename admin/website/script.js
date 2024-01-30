let currentRoundIndex = -1;

function playGame() {
    const xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);

            if (data.length > 0) {
                currentRoundIndex++;

                if (currentRoundIndex < data.length) {
                    const currentRound = data[currentRoundIndex];

                    displayMaskedVideo(currentRound.masked_video);
                    displayMultiChoiceAnswers(currentRound.answers);

                    setTimeout(function () {
                        revealSinger(currentRound.correct_answer);
                    }, 10000); // Adjust the time delay as needed
                } else {
                    alert("Game Over. No more rounds.");
                }
            } else {
                alert("No rounds found in the database.");
            }
        }
    };

    xhr.open("GET", "get_rounds.php", true);
    xhr.send();
}

function displayMaskedVideo(videoPath) {
    const clipContainer = document.getElementById("celebrity-clip-container");
    clipContainer.classList.remove("hidden");

    document.getElementById("celebrity-clip").src = videoPath;
    document.getElementById("celebrity-clip").setAttribute("alt", "Masked Singer");
}

function displayMultiChoiceAnswers(answers) {
    const answersContainer = document.getElementById("answers-container");
    answersContainer.innerHTML = "";

    answers.forEach(function (answer, index) {
        const button = document.createElement("button");
        button.textContent = answer;
        button.addEventListener("click", function () {
            handleAnswerClick(answer);
        });

        answersContainer.appendChild(button);
    });
}

function handleAnswerClick(selectedAnswer) {
    alert("Selected Answer: " + selectedAnswer);
    playGame();
}

function revealSinger(correctAnswer) {
    const clipContainer = document.getElementById("celebrity-clip-container");
    clipContainer.classList.remove("hidden");

    document.getElementById("celebrity-clip").src = "path/to/reveal_video.mp4";
    document.getElementById("celebrity-clip").setAttribute("alt", correctAnswer);
}
