const questions = [
    {
        question: "A: ___ you a teacher? B: Yes, I ___",
        answers: [
            { text: "Are, am", correct: true },
            { text: "Is, am", correct: false },
            { text: "Are, are", correct: false },
            { text: "Do, am", correct: false },
        ]
    },
    {
        question: "A: ___ your children here? B: No, they ___",
        answers: [
            { text: "Are, aren't", correct: true },
            { text: "am, isn't", correct: false },
            { text: "Is, are", correct: false },
            { text: "Do, aren't", correct: false },
        ]
    },
    {
        question: "A: Where ___ we? B: I think this ___  Oxford street.",
        answers: [
            { text: "are, Is", correct: true },
            { text: "Is, are", correct: false },
            { text: "am, are", correct: false },
            { text: "are, are", correct: false },
        ]
    },
    {
        question: "A: ___ your friends from the UK? B: No, ___ from the US.",
        answers: [
            { text: "Are, he is", correct: false },
            { text: "Is, they are", correct: false },
            { text: "They are, are", correct: false },
            { text: "Are, they are", correct: true },
        ]
    },
    {
        question: "A: ___ David and Molly here? B: Yes, ___  next to the door.",
        answers: [
            { text: "Is, we're", correct: false },
            { text: "Are, they're", correct: true },
            { text: "They are, are", correct: false },
            { text: "Is, they", correct: false },
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
    document.cookie = `user_grade=${grade}; path=/`;
    let lessonString = "a1_lesson1";
    document.cookie = `user_lesson=${lessonString}; path=/`;
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
