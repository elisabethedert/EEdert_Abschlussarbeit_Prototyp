<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import {usePage} from '@inertiajs/vue3'

const props = defineProps({
    questions: Object
})

const currentIndex = ref(0);
const resultCorrect = ref(false);
const resultIncorrect = ref(false);
const totalQuestions = computed(() =>
    props.questions.length
)

const currentLecture = ref(0);

const endLecture = ref(false);

const selectedAnswer = ref(null)
const result = ref(0)

const currentQuestion = computed(() => {
    return props.questions[currentIndex.value]
})

const isLastQuestion = computed(() => currentIndex.value === props.questions.length - 1)

const answers = computed(() => {
    return props.questions[currentIndex.value].multiple_choice_answers
})

function selectedOption(index) {
    selectedAnswer.value = index
}
function hideResult() {
    resultCorrect.value = false;
    resultIncorrect.value = false;
}

function nextQuestion() {
    var choosenAnswer = props.questions[currentIndex.value].multiple_choice_answers[selectedAnswer.value];
    setTimeout(hideResult, 2000);

    if (selectedAnswer.value !== null) {
        if (choosenAnswer.correct_answer == 1) {
            result.value++;
            console.log("user id" + usePage().props.auth.user.id)
            console.log("id: " + props.questions[currentIndex.value].id)
            saveQuestionResult();
            resultCorrect.value = true;
        } else {
            saveQuestionResult();
            resultIncorrect.value = true;
        }
    }
    currentIndex.value++;
    selectedAnswer.value = null;
}

function databaseEntry(userId, questionId, choosenAnswerValue) {
    fetch(`/question_results?user_id=${userId}&question_id=${questionId}`)
    .then(response => {
        console.log("Das ist der Response:");
        console.log(response);
        if (!response.ok) {
            throw new Error('Fehler beim Abrufen der Daten.');
        }
        return response.json();
    })
    .then(data => {
        console.log("Das ist der Data:");
        console.log(data);
        
        if(data.status === "success") {
            console.log("Juhu Frage existiert, Result muss geupdated werden, hier nochmal data:")
            console.log(data)
            console.log("Data question_count")
            console.log(data.data.question_count);
            console.log("Data question question_correct_count")
            console.log(data.data.question_correct_count);
            console.log("Data question_incorrect_count")
            console.log(data.data.question_incorrect_count);

            var questionCount = data.data.question_count;
            var questionCorrectCount = data.data.question_correct_count;
            var questionIncorrectCount = data.data.question_incorrect_count;

            if (choosenAnswerValue == 1){
                router.put('/question_results', {
                    question_count: questionCount++,
                    question_correct_count: questionCorrectCount++,
                    question_incorrect_count: questionIncorrectCount,
                })
                console.log("put richtige antwort hat geklappt")
            } else {
                router.put('/question_results', {
                    question_count: questionCount++,
                    question_correct_count: questionCorrectCount,
                    question_incorrect_count: questionIncorrectCount++,
                })
                console.log("put falsche antwort hat geklappt")
            }
            console.log("questionCount"+questionCount)
            console.log("questionCorrectCount"+questionCorrectCount)
            console.log("questionIncorrectCount"+questionIncorrectCount)
            
        } else if(data.status === "error") {
            console.log("Nooo Frage existiert nicht, Result muss angelegt werden")
            // if the entry does not exist, create a new entry
            router.post('/question_results', {
                user_id: usePage().props.auth.user.id,
                question_id: props.questions[currentIndex.value].id,
                question_type: 100, //TODO
                question_count: 1,
                question_correct_count: 0, //TODO if answer correct
                question_incorrect_count: 0, //TODO if answer incorrect
                lecture: props.questions[currentIndex.value].lecture,
                unit: props.questions[currentIndex.value].unit,
            })
            console.log("Frage wurde angelegt")
        }
    })
    .catch(error => {
        console.error('Fehler beim Überprüfen des Ergebnisses:', error);
    });
};

function saveQuestionResult() {
    console.log("User id:")
    console.log(usePage().props.auth.user.id)
    console.log("richtig beantwortet?")
    console.log(props.questions[currentIndex.value].multiple_choice_answers[selectedAnswer.value].correct_answer)
    databaseEntry(usePage().props.auth.user.id, props.questions[currentIndex.value].id, props.questions[currentIndex.value].multiple_choice_answers[selectedAnswer.value].correct_answer)
}

function calculateResult() {
    var choosenAnswer = props.questions[currentIndex.value].multiple_choice_answers[selectedAnswer.value];
    setTimeout(hideResult, 2000);
    if (choosenAnswer.correct_answer == 1) {
        result.value++;
        console.log(result.value)
        resultCorrect.value = true;
    } else {
        resultIncorrect.value = true;
    }

    router.post('/results', [
        {
            results: {
                'score': result.value,
                'totalQuestions': totalQuestions.value
            }
        }
    ])
}
</script>

<template>
    <Head title="Spiel" />

    <AuthenticatedLayout>
        <h1>Spiel</h1>

        <div class="question-counter">
            <p>Frage id: {{ currentQuestion.id }}<br></p>
            <p>Topic: {{ currentQuestion.topic }}<br></p>
            <p>Unit: {{ currentQuestion.unit }}<br></p>
            <p>Lektion: {{ currentQuestion.lecture }}<br></p>
            <p>
                Frage {{ currentIndex + 1 }} von {{ totalQuestions }}
            </p>
        </div>
        <div class="question-containe">
            <div class="list-group">
                <a aria-current="true">
                    <div class="">
                        <h3>{{ currentQuestion.question }}?</h3>
                    </div>
                </a>
                <a @click="selectedOption(index)" v-for="(answer, index) in answers"
                    :class="{ 'selected': index === selectedAnswer }" class="answer" aria-current="true">
                    <div class="">
                        <div>
                            <p class="">{{ answer.answer }}</p>
                        </div>
                    </div>
                </a>
                <div v-if="resultCorrect">
                    Resuuuuult richtig
                </div>
                <div v-if="resultIncorrect">
                    Resuuuuult falsch
                </div>
                <div>
                    <button @click="nextQuestion" v-if="!isLastQuestion" class="btn btn-green">Bestätigen</button>
                    <button @click="calculateResult" v-if="isLastQuestion" class="btn btn-yellow">Lektion beenden</button>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped>
@import '../../css/_main.scss';

.question-counter {
    /* display: flex; */
    font-weight: 600;
}

.answer {
    cursor: pointer;
    padding: 2rem;
    display: flex;
}

.selected {
    background: green;
}
</style>