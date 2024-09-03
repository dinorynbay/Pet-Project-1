const questions = [
    {
        question: "___ you a teacher? B: Yes, I ___",
        answers: [
            { text: "Are, am", correct: true },
            { text: "Is, am", correct: false },
            { text: "Are, are", correct: false },
            { text: "Do, am", correct: false },

        ]
    },
    {
        question: "Where ___ on holiday last summer?",
        answers: [
            { text: "did you go", correct: true },
            { text: "went you", correct: false },
            { text: "did you went", correct: false },
            { text: "were you go", correct: false },

        ]
    },
    {
        question: "I'm hungry. B: ___ make some bacon and eggs.",
        answers: [
            { text: "Do", correct: false },
            { text: "Shall we", correct: false },
            { text: "Shall I", correct: false },
            { text: "I'll", correct: true },

        ]
    },
    {
        question: "___ ask you a question?",
        answers: [
            { text: "I can", correct: false },
            { text: "Can I", correct: true },
            { text: "Do I can", correct: false },
            { text: "Did I can", correct: false },

        ]
    },
    {
        question: "Pam loves ___ letters.",
        answers: [
            { text: "receivings", correct: false },
            { text: "receiving", correct: true },
            { text: "recieve", correct: false },
            { text: "received", correct: false },

        ]
    },
    {
        question: "___ to Rome?",
        answers: [
            { text: "Have ever you been", correct: false },
            { text: "Have you ever been", correct: true },
            { text: "Have you been ever", correct: false },
            { text: "Ever you have been", correct: false },

        ]
    },
    {
        question: "Do you want me to ___ you a coffee?",
        answers: [
            { text: "get", correct: false },
            { text: "do", correct: false },
            { text: "make", correct: true },
            { text: "close", correct: false },

        ]
    },
    {
        question: "If you ___ now, you ___ the rain.",
        answers: [
            { text: "didn't leave, 'll miss", correct: false },
            { text: "don't leave, did miss", correct: false },
            { text: "don't leave, 'll miss", correct: true },
            { text: "won't leave, miss", correct: false },

        ]
    },
    {
        question: "Do you have time ___ a cup of tea?",
        answers: [
            { text: "for", correct: true },
            { text: "to", correct: false },
            { text: "at", correct: false },
            { text: "about", correct: false },

        ]
    },
    {
        question: "She offered ___ me. ",
        answers: [
            { text: "helped", correct: false },
            { text: "helping", correct: false },
            { text: "to help", correct: true },
            { text: "help", correct: false },

        ]
    },
    {
        question: "This book belongs ___ me.",
        answers: [
            { text: "at", correct: false },
            { text: "of", correct: false },
            { text: "with", correct: false },
            { text: "to", correct: true },

        ]
    },
    {
        question: "How long have you been married ___ Liam?",
        answers: [
            { text: "in", correct: false },
            { text: "with", correct: false },
            { text: "to", correct: true },
            { text: "for", correct: false },

        ]
    },

    {
        question: "She often talks to ___ when she is stressed.",
        answers: [
            { text: "she", correct: false },
            { text: "herself", correct: true },
            { text: "her", correct: false },
            { text: "hers", correct: false },

        ]
    },
    {
        question: "Mum, where is ___ dog? I want to take it to ___ park.",
        answers: [
            { text: "-, -", correct: false },
            { text: "the, the", correct: true },
            { text: "a, the", correct: false },
            { text: "a, a", correct: false },

        ]
    },
    {
        question: "Only two computers work, all the ___ don't.",
        answers: [
            { text: "another", correct: false },
            { text: "other", correct: false },
            { text: "others", correct: true },
            { text: "the others", correct: false },

        ]
    },
    {
        question: "Would you like a ___",
        answers: [
            { text: "glass wine", correct: false },
            { text: "wine glass", correct: false },
            { text: "glass of wine", correct: true },
            { text: "wine's glass", correct: false },

        ]
    },
    {
        question: "I saw he had a gun, but I didn't think he ___",
        answers: [
            { text: "was shooting", correct: false },
            { text: "shoot", correct: false },
            { text: "will shoot", correct: false },
            { text: "was going to shoot", correct: true },

        ]
    },
    {
        question: "___ to be a lot of confusion and misinformation about the accident.",
        answers: [
            { text: "There seems", correct: true },
            { text: "It seems", correct: false },
            { text: "It would appear", correct: false },
            { text: "That seems", correct: false },

        ]
    },
    {
        question: "I'd love ___ last night's performance.",
        answers: [
            { text: "to be see", correct: false },
            { text: "to be seeing", correct: false },
            { text: "to have seen", correct: true },
            { text: "to be seen", correct: false },

        ]
    },
    {
        question: "The north of the country is industrialised and rich ___ the south is quite poor, with an economy based on agriculture.",
        answers: [
            { text: "on the whole", correct: false },
            { text: "whereas", correct: true },
            { text: "furthermore", correct: false },
            { text: "further", correct: false },

        ]
    },

];

const questionElement = document.getElementById("question");
const answerOptions = document.getElementById("answer-options");
const nextQuestionButton = document.getElementById("next-question-btn");
const finishQuizButton = document.getElementById("finish-quiz-btn");
let currentQuestionIndex = 0;
let score = 0;

function startQuiz() {
    currentQuestionIndex = 0;
    score = 0;
    nextQuestionButton.innerHTML = "Следующий вопрос";
    finishQuizButton.style.display = "none";

    showQuestion();
}

function showQuestion() {
    resetState();
    let currentQuestion = questions[currentQuestionIndex];
    let questionNumber = currentQuestionIndex + 1;
    questionElement.innerHTML = questionNumber + ". " + currentQuestion.question;

    currentQuestion.answers.forEach(answer => {
        const button = document.createElement("button");
        button.innerHTML = answer.text;
        button.classList.add("response");
        answerOptions.appendChild(button);
        if (answer.correct) {
            button.dataset.correct = answer.correct;
        }
        button.addEventListener("click", selectAnswer);
    })
}

function resetState() {
    nextQuestionButton.style.display = "none";
    while (answerOptions.firstChild) {
        answerOptions.removeChild(answerOptions.firstChild);
    }
}

function selectAnswer(e) {
    const selectedButton = e.target;

    const isCorrect = selectedButton.dataset.correct === "true";
    if (isCorrect) {
        selectedButton.classList.add("correct");
        score++;
    }
    else {
        selectedButton.classList.add("incorrect");
    }

    Array.from(answerOptions.children).forEach(button => {
        if (button.dataset.correct === "true") {
            button.classList.add("correct");
        }
        button.disabled = true;
    });
    nextQuestionButton.style.display = "block";
}

function showScore() {
    resetState();
    let level = "";
    if (score >= 0 && score <= 5) {
        level = "A1";
    } else if (score >= 6 && score <= 10) {
        level = "A1";
    } else if (score >= 11 && score <= 13) {
        level = "A2";
    } else if (score >= 14 && score <= 17) {
        level = "B1";
    }
    else if (score >= 18 && score <= 20) {
        level = "B2";
    }
    questionElement.innerHTML = `Вы набрали ${score} из ${questions.length}! Рекомендуем вам начать обучение с - ${level}.`;
    nextQuestionButton.innerHTML = "Пройти занова";
    nextQuestionButton.style.display = "block";
    finishQuizButton.style.display = "block";

}

function handleNextQuestionButton() {
    currentQuestionIndex++;
    if (currentQuestionIndex < questions.length) {
        showQuestion();
    }
    else {
        showScore();
    }
}

nextQuestionButton.addEventListener("click", () => {
    if (currentQuestionIndex < questions.length) {
        handleNextQuestionButton();
    }
    else {
        startQuiz();
    }
});

finishQuizButton.addEventListener("click", function () {
    const level = determineLevel(score);
    document.cookie = `user_level=${level}; path=/`;
    window.location.href = "../inc/update_level.php";
});

function determineLevel(score) {
    if (score >= 0 && score <= 5) {
        return "A1";
    } else if (score >= 6 && score <= 10) {
        return "A1";
    } else if (score >= 11 && score <= 13) {
        return "A2";
    } else if (score >= 14 && score <= 17) {
        return "B1";
    }
    else if (score >= 18 && score <= 20) {
        return "B2";
    }
}

startQuiz();