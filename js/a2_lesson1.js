const questions = [
    {
        question: "___ to Rome?",
        answers: [
            { text: "Have ever you been", correct: false },
            { text: "Have you ever been", correct: true },
            { text: "Have you been ever", correct: false },
            { text: "Have ever been you", correct: false },
        ]
    },
    {
        question: "Have you had lunch ___?",
        answers: [
            { text: "yet", correct: true },
            { text: "just", correct: false },
            { text: "already", correct: false },
            { text: "before", correct: false },
        ]
    },
    {
        question: "I ___ the keys that I lost yet.",
        answers: [
            { text: "haven't find", correct: false },
            { text: "haven't finded", correct: false },
            { text: "haven't found", correct: true },
            { text: "hadn't found", correct: false },
        ]
    },
    {
        question: "I ___ Peter since I was 5 years old.",
        answers: [
            { text: "know", correct: false },
            { text: "'ve known", correct: true },
            { text: "'ve knew", correct: false },
            { text: "knew", correct: false },
        ]
    },
    {
        question: "I ___ my pen. Can I use yours?",
        answers: [
            { text: "'ve losed", correct: false },
            { text: "lose", correct: false },
            { text: "have lost", correct: true },
            { text: "lost", correct: false },
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
    let lessonString = "a2_lesson1";
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
