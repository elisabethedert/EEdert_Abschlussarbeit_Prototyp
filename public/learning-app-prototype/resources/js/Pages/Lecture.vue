<style scoped>
@import '../../css/_main.scss';
</style>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import axios from 'axios';


const props = defineProps({
    questions: Object
})

const page = usePage();

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
const answersDd = computed(() => {
    const blanks = props.questions[currentIndex.value].blanks;
    const words = blanks.split(' ');
    const newWordsArray = words.filter(word => word !== '').map(word => word.replace(/["\[\],]/g, ''));
    return newWordsArray;
})

var count = 0;

function selectedOption(index) {
    selectedAnswer.value = index
}
function hideResult() {
    resultCorrect.value = false;
    resultIncorrect.value = false;
}

function saveResult() {
    axios.post('/question_results', {
        user_id: page.props.auth.user.id,
        question_id: props.questions[currentIndex.value].id,
        answer_id: props.questions[currentIndex.value].multiple_choice_answers[selectedAnswer.value].id,
        question_type: props.questions[currentIndex.value].type,
        lecture: props.questions[currentIndex.value].lecture,
        unit: props.questions[currentIndex.value].unit,
    }).then(response => {
        console.log(response.data.message);
        if (response.data.message == "correct") {
            result.value++;
            resultCorrect.value = true;
        } else {
            resultIncorrect.value = true;
        }
    }).catch(error => {
        console.error(error);
    });
}

function nextQuestion() {
    setTimeout(hideResult, 2000);
    saveResult();

    currentIndex.value++;
    selectedAnswer.value = null;
    var maxCount = props.questions.length;
    count = count === maxCount ? maxCount : count + 1;
    progressbar(count, maxCount);
}

console.log(currentQuestion.blanks)

function calculateResult() {
    setTimeout(hideResult, 2000);
    saveResult();

    // TODO: länger warten, bis das Ergebnis der Lektion angezeigt wird und das Ergebnis der Frage zunächst zeigen
    // Button verzögert zeigen, der auf das Lektionsergebnis führt
    router.post('/results', [
        {
            results: {
                'score': result.value,
                'totalQuestions': totalQuestions.value
            }
        }
    ]);
}

function progressbar(count, maxCount) {
    var newWidth = (count / maxCount) * 100 + "%";
    document.getElementsByClassName("progress-bar")[0].style.width = newWidth;
}

</script>

<template>
    <Head title="Spiel" />

    <AuthenticatedLayout>
        <div class="info-header">
            <h1>Unit {{ currentQuestion.unit }} - Lektion {{ currentQuestion.lecture }}</h1>
            <h2>{{ currentQuestion.topic }}</h2>
        </div>

        <div class="question-container">
            <div class="question-header">
                <div class="question-counter">
                    <p class="question-counter"><b>Frage {{ currentIndex + 1 }} von {{ totalQuestions }}</b></p>
                    <div class="progress">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                </div>

                <div class="help-icon">
                    <p>i</p>
                </div>
            </div>
            <div v-if="currentQuestion.type === 'mc'">
                <div class="question-main">
                    <div class="question">
                        <div class="">
                            <h2>{{ currentQuestion.question }}</h2>
                        </div>
                    </div>
                    <div class="answers">
                        <div v-for="(answer, index) in answers" :key="index" class="answer">
                            <label :class="{ 'selected': index === selectedAnswer }">
                                <input type="radio" :value="index" v-model="selectedAnswer" @change="selectedOption(index)"
                                    aria-current="true" class="btn-radio">
                                <span class="answer-text">{{ answer.answer }}</span>
                            </label>
                        </div>

                    </div>
                </div>
            </div>

            <div v-if="currentQuestion.type === 'dd'" class="question-counter">
                <div class="question-main">
                    <div class="question">
                        <div class="">
                            <h2>{{ currentQuestion.question }}</h2>
                        </div>
                    </div>
                    <div class="answer-dd">
                        <button v-for="(item, index) in answersDd" :key="index">
                            {{ item }}
                        </button>
                    </div>
                </div>
            </div>
            <div class="question-footer">
                <div v-if="resultCorrect">
                    Resuuuuult richtig
                </div>
                <div v-if="resultIncorrect">
                    Resuuuuult falsch
                </div>
                <button @click="nextQuestion" v-if="!isLastQuestion" class="btn btn-green">Bestätigen</button>
                <button @click="calculateResult" v-if="isLastQuestion" class="btn btn-yellow">Lektion</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.info-header {
    text-align: center;

    h1 {
        margin-bottom: 0;
        font-size: 2rem;
    }

    h2 {
        font-size: 1.75rem;
    }
}

.question-container {

    .question-header {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        margin-bottom: 2rem;
        align-items: center;

        .question-counter {
            p {
                margin-bottom: 1rem;
            }

            .progress {
                width: 250px;
                height: 20px;
                background-color: $blue;
                align-items: first baseline;
                display: flex;
                border-radius: 50px;

                &-bar {
                    border-radius: 50px;
                    width: 0%;
                    height: 15px;
                    background-color: $blue-light;
                    color: #ffffff;
                    display: flex;
                    align-items: center;

                    span {
                        text-align: center;
                        margin-left: 10px;
                    }
                }
            }
        }
    }

    .help-icon {
        background-color: $green;
        width: 30px;
        height: 30px;
        border-radius: 25px;
        text-align: center;
        line-height: 30px;
        color: $white;
        font-size: 1.5rem;
    }

    background-color: $background-light;
    border-radius: 25px;
    margin: 1rem;
    padding: 2rem;

    .question-main {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        gap: 3rem;
        margin: 4rem;

        .question {
            width: 40%;

            h2 {
                font-size: 2rem;
            }
        }

        .answers {
            width: 60%;
            display: flex;
            flex-direction: column;
            gap: 1rem;

            .answer {

                label {
                    display: flex;
                    align-items: center;

                    span {
                        font-size: 1.5rem;
                        color: $blue;
                    }
                }

                input[type="radio"] {
                    appearance: none;
                    -webkit-appearance: none;
                    width: 23px;
                    height: 23px;
                    border: 3px solid #67917B;
                    border-radius: 50%;
                    outline: none;
                    margin-right: 2rem;
                    position: relative;
                    background-color: $background-light;
                    cursor: pointer;

                    &:checked::before {
                        content: '';
                        display: block;
                        width: 10px;
                        height: 10px;
                        border-radius: 50%;
                        background: #67917B;
                        position: absolute;
                        top: 4px;
                        left: 4px;
                    }
                }
            }
        }

    }

    .question-footer {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;

        button {
            margin-bottom: 2rem;
        }


    }
}
</style>