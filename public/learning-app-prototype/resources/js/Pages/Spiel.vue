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
            resultIncorrect.value = true;
        }
    }
    currentIndex.value++;
    selectedAnswer.value = null;
}

function saveQuestionResult() {
    router.post('/question_results', {
            user_id: usePage().props.auth.user.id,
            question_id: props.questions[currentIndex.value].id,
            question_type: 100,
            question_count: 1,
            question_correct_count: 1,
            question_incorrect_count: 0,
            lecture: props.questions[currentIndex.value].lecture,
            unit: props.questions[currentIndex.value].unit,
        })
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