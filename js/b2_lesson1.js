const questions = [
    {
        question: "Would you like a ___",
        answers: [
            { text: "glass of wine", correct: true },
            { text: "wine glass", correct: false },
            { text: "wine's glass", correct: false },
            { text: "glasses of wine", correct: false },
        ]
    },
    {
        question: "There are two big ___  outside the walls.",
        answers: [
            { text: "cars parks", correct: false },
            { text: "parks of cars", correct: false },
            { text: "car park", correct: true },
            { text: "park of car", correct: false },
        ]
    },
    {
        question: "This is ___",
        answers: [
            { text: "a Javier friend", correct: false },
            { text: "a Javier's friend", correct: false },
            { text: "a friend of Javier's", correct: true },
            { text: "friends of Javier's", correct: false },
        ]
    },
    {
        question: "I need to buy a new ___",
        answers: [
            { text: "copmuter's keyboard", correct: false },
            { text: "keyboard of computer", correct: false },
            { text: "computer keyboard", correct: true },
            { text: "computer of keyboard", correct: false },
        ]
    },
    {
        question: "Are you coming to ___",
        answers: [
            { text: "Sunday party", correct: false },
            { text: "Sunday's party", correct: true },
            { text: "the party of Sunday", correct: false },
            { text: "Sunday", correct: false },
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
    let grade = determineLevel(score);
    questionElement.innerHTML = `Вы набрали ${score} из ${questions.length}! Оценка - ${grade}.`;
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
    let grade = determineLevel(score);
    let lessonString = "b2_lesson1";
    document.cookie = `user_lesson=${lessonString}; path=/`;
    document.cookie = `user_grade=${grade}; path=/`;
    window.location.href = "inc/insert_grade.php";
});

function determineLevel(score) {
    if (score >= 0 && score <= 1) {
        return "Плохо";
    } else if (score == 2 || score == 3) {
        return "Удовлетворительно";
    } else if (score == 4) {
        return "Хорошо";
    } else if (score == 5) {
        return "Отлично";
    }
}

startQuiz();
