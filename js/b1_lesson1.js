const questions = [
    {
        question: "I waited ___ you for more than an hour.",
        answers: [
            { text: "at", correct: false },
            { text: "about", correct: false },
            { text: "for", correct: true },
            { text: "of", correct: false },
        ]
    },
    {
        question: "I'm looking forward ___ seeing you.",
        answers: [
            { text: "at", correct: false },
            { text: "to", correct: true },
            { text: "for", correct: false },
            { text: "about", correct: false },
        ]
    },
    {
        question: "We arrived ___ the station too late.",
        answers: [
            { text: "of", correct: false },
            { text: "at", correct: true },
            { text: "to", correct: false },
            { text: "in", correct: false },
        ]
    },
    {
        question: "We are thinking ___ going on a trip to Venice.",
        answers: [
            { text: "in", correct: false },
            { text: "of", correct: true },
            { text: "at", correct: false },
            { text: "to", correct: false },
        ]
    },
    {
        question: "This book belongs ___ me.",
        answers: [
            { text: "at", correct: false },
            { text: "of", correct: false },
            { text: "to", correct: true },
            { text: "with", correct: false },
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
    let lessonString = "b1_lesson1";
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
