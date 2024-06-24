<style scoped>
@import '../../css/_main.scss';
</style>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AnimationContainer from '@/Components/Animations/AnimationContainer.vue';
import HappyDance from '@/Components/Animations/HappyDance.vue';
import SadDance from '@/Components/Animations/SadDance.vue';
import MultipleChoice from '@/Components/QuestionTypes/MultipleChoice.vue';
import HelpPopup from '@/Components/HelpPopup.vue';
import Arrow from '@/assets/Arrow.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import { usePage } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import axios from 'axios';


const currentSession = crypto.randomUUID();

const props = defineProps({
    questions: Object
})

const isPopupVisible = ref(false);

function showHelpPopup() {
    isPopupVisible.value = true;
}

const currentIndex = ref(0);
const resultCorrect = ref(false);
const resultIncorrect = ref(false);
const totalQuestions = computed(() =>
    props.questions.length
)

const selectedAnswer = ref(null)
const result = ref(0)
const showQuestion = ref(true);

const currentQuestion = computed(() => {
    if (props.questions[currentIndex.value].type === 'dd') {
        splitString(props.questions[currentIndex.value].question);
    }
    return props.questions[currentIndex.value]
})

const isLastQuestion = computed(() => currentIndex.value === props.questions.length - 1)

const answers = computed(() => {
    return props.questions[currentIndex.value].multiple_choice_answers
})

const answersDd = computed(() => {
    return props.questions[currentIndex.value].blanks;
});

var count = 0;

function selectedOption(index) {
    selectedAnswer.value = index
}
function hideResult() {
    resultCorrect.value = false;
    resultIncorrect.value = false;
    showQuestion.value = true;
}

function saveMcResult() {
    axios.post('/question_results', {
        question_id: props.questions[currentIndex.value].id,
        answer_id: props.questions[currentIndex.value].multiple_choice_answers[selectedAnswer.value].id,
        question_type: props.questions[currentIndex.value].type,
        lecture: props.questions[currentIndex.value].lecture,
        unit: props.questions[currentIndex.value].unit,
        session: currentSession
    }).then(response => {
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

function saveDdResult() {

    const droppedButtons = ref([]);
    droppedButtons.value = Array.from(document.querySelectorAll('.dragbtn')).map(button => button.textContent);

    console.log(droppedButtons.value);
    // TODO korrekte Datenweiterletung an BE
    axios.post('/question_results', {
        question_id: props.questions[currentIndex.value].id,
        //
        dropped_buttons: droppedButtons.value,
        //
        question_type: props.questions[currentIndex.value].type,
        lecture: props.questions[currentIndex.value].lecture,
        unit: props.questions[currentIndex.value].unit,
        session: currentSession
    }).then(response => {
        if (response.data.message == "orderCorrect") {
            result.value++;
            resultCorrect.value = true;
        } else {
            resultIncorrect.value = true;
        }
    }).catch(error => {
        console.error(error);
    });
}

function dropboxEmpty() {
    const dropboxes = document.querySelectorAll('.dropbox');
    for (let dropbox of dropboxes) {
        if (dropbox.children.length === 0) {
            return true
        }
    }
    return false
}


function nextQuestion() {
    if (props.questions[currentIndex.value].type === "dd" && (dropboxEmpty())) {
        return;
    }
    showQuestion.value = false;
    setTimeout(hideResult, 4500);
    if (props.questions[currentIndex.value].type === "mc") {
        saveMcResult();
        selectedAnswer.value = null;
    } else if (props.questions[currentIndex.value].type === "dd") {
        saveDdResult();
        sentenceParts.value = [];
    }
    // show next question
    currentIndex.value++;

    //Check if there are associated buttons in dropbox spans
    const dropboxSpans = document.querySelectorAll('.dropbox button');
    if (dropboxSpans.length > 0) {
        // Move the buttons back to the answer-dd div
        const answerDdDiv = document.querySelector('.answer-dd');
        dropboxSpans.forEach(btn => {
            btn.remove();
            answerDdDiv.appendChild(btn)
        });
    }

    dropTargets.value = {};

    // progressbar
    var maxCount = props.questions.length;
    count = count === maxCount ? maxCount : count + 1;
    progressbar(count, maxCount);
}

function calculateResult() {
    setTimeout(hideResult, 2000);
    if (props.questions[currentIndex.value].type === "mc") {
        saveMcResult();
        selectedAnswer.value = null;
    } else if (props.questions[currentIndex.value].type === "dd") {
        saveDdResult();
        sentenceParts.value = [];
    }
    // TODO: länger warten, bis das Ergebnis der Lektion angezeigt wird und das Ergebnis der Frage zunächst zeigen
    // Button verzögert zeigen, der auf das Lektionsergebnis führt
    router.get(`/unit1/lektion${props.questions[currentIndex.value].lecture}/result/${currentSession}`);
}

function progressbar(count, maxCount) {
    var newWidth = (count / maxCount) * 100 + "%";
    document.getElementsByClassName("progress-bar")[0].style.width = newWidth;
}

const sentenceParts = ref([]);
const draggedItem = ref(null);
const dropTargets = ref({});

function isGap(part) {
    // true wenn der Teil aus Unterstrichen besteht
    return /^___+$/.test(part.trim());
};

const gapIndex = (index) => {
    return sentenceParts.value.slice(0, index).filter(isGap).length;
};

function splitString(currentQ) {
    // Rexex erkennt Unterstriche im String
    const regex = /(_{3})(?=[,.\s]|$)/g
    let parts = currentQ.split(regex);

    // Entferne leere Einträge aus dem parts Array
    parts = parts.filter(part => part !== undefined && part !== "");
    for (let i = 0; i < parts.length; i++) {
        sentenceParts.value.push(parts[i]);
    }
};

function allowDrop(event) {
    event.preventDefault();
}

function drag(event) {
    draggedItem.value = { id: event.target.id, originalContainer: event.target.parentElement };
    event.dataTransfer.setData("text", event.target.id);
}

function drop(event, gapIndex) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const targetElement = document.getElementById(`div${gapIndex}`); // div class="dropbox"
    const draggedElement = document.getElementById(data);

    if (targetElement && draggedElement) {
        if (targetElement.children.length > 0) {
            return;
        }

        // Füge das neue Element hinzu und entferne es aus der ursprünglichen Liste
        targetElement.appendChild(draggedElement);
        // Füge das neue Element hinzu und entferne es aus der ursprünglichen Liste
        targetElement.insertBefore(draggedElement, targetElement.firstChild);

        // Aktualisiere den dropTargets Eintrag
        dropTargets.value[`div${gapIndex}`] = draggedElement;
    }
}

function dropToAnswerDD(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const draggedElement = document.getElementById(data);

    if (draggedElement && draggedItem.value.originalContainer.className !== "answer-dd") {
        // Entfernen des existierenden Elements aus der Lücke
        const gapIndexKey = Object.keys(dropTargets.value).find(key => dropTargets.value[key] === draggedElement);
        if (gapIndexKey) {
            dropTargets.value[gapIndexKey] = null;
        }

        // Zurücksetzen des existierenden Elements in den ursprünglichen Container
        if (event.target.className == "answer-dd") {
            event.target.appendChild(draggedElement);
        }
    }
}

const showXp = ref(false);
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
                    <button @click="showHelpPopup"><svg width="8" height="18" viewBox="0 0 8 31" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M1.26552 11.4094C0.782478 19.6357 0.800904 19.2007 0.808079 27.4404C0.805653 28.7934 1.71479 30.0084 3.13147 30.1054C4.40848 30.1928 5.80327 29.1456 5.80638 27.7826C5.78923 19.5422 5.7708 19.9772 6.25385 11.751C6.44387 8.53645 1.45555 8.19491 1.26552 11.4094Z" />
                            <ellipse cx="4.5" cy="3" rx="2.5" ry="3" />
                        </svg>
                    </button>
                    <HelpPopup :visible="isPopupVisible" @showhelp="isPopupVisible = $event">
                        <p v-if="currentQuestion.type === 'mc'"><b>Tipp:</b> Wähle die richtige Antwort aus</p>
                        <p v-if="currentQuestion.type === 'dd'"><b>Tipp:</b> Ziehe die gelben Buttons in die Lücke</p>
                    </HelpPopup>
                </div>
            </div>
            <!-- MC Section -->
            <!-- <MultipleChoice/> -->

            <div v-if="currentQuestion.type === 'mc'">
                <div class="question-main" v-if="showQuestion">
                    <div class="question">
                        <div class="">
                            <h2>{{ currentQuestion.question }}</h2>
                        </div>
                    </div>
                    <div class="answers">
                        <div v-for="(answer, index) in answers" :key="index" class="answer">
                            <label :class="{ 'selected': index === selectedAnswer }">
                                <input type="radio" :value="index" v-model="selectedAnswer"
                                    @change="selectedOption(index)" aria-current="true" class="btn-radio">
                                <span class="answer-text">{{ answer.answer }}</span>
                            </label>
                        </div>

                    </div>
                </div>
            </div>
            <!-- DD Section -->
            <div v-if="currentQuestion.type === 'dd'" class="question-counter">
                <div class="question-main" v-if="showQuestion">
                    <div class="question">
                        <template v-for="(part, index) in sentenceParts" :key="index">
                            <span v-if="isGap(part)" class="dropbox" :id="'div' + gapIndex(index)"
                                @drop="drop($event, gapIndex(index))" @dragover="allowDrop">________________
                            </span>
                            <span class="text" v-else>{{ part }}</span>
                        </template>
                    </div>
                    <div class="answer-dd" @drop="dropToAnswerDD" @dragover="allowDrop">
                        <button v-for="(item, index) in answersDd" :key="index" class="dragbtn btn btn-yellow"
                            :id="'drag' + index" draggable="true" @dragstart="drag($event, index)">
                            {{ item }}
                        </button>
                    </div>
                </div>
            </div>

            <div class="question-animation">
                <div v-if="resultCorrect">
                    <AnimationContainer :showXp="true">
                        <template #result>
                            <h3>Richtig!</h3>
                        </template>
                        <template #figure>
                            <HappyDance />
                        </template>
                    </AnimationContainer>
                </div>
                <div v-if="resultIncorrect">
                    <AnimationContainer :showXp="false">
                        <template #result>
                            <h3>Leider falsch..</h3>
                        </template>
                        <template #figure>
                            <SadDance />
                        </template>
                    </AnimationContainer>
                </div>
            </div>

            <div class="question-footer" v-if="showQuestion">
                <button @click="nextQuestion" v-if="!isLastQuestion" class="btn btn-green">Bestätigen</button>
                <button @click="calculateResult" v-if="isLastQuestion" class="btn btn-yellow">Lektion beenden
                    <Arrow />
                </button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.question-animation {
    h3 {
        font-size: 1.5rem;
        color: $blue;
    }
}

.dropbox {
    height: 55px;
    border: none;
    text-decoration: none;
    display: inline-block;
}

.question span {
    line-height: 0;
    width: 200px;
    font-size: 1.5rem;
    color: $blue;
    font-weight: bold;
}

.question {
    &:hover {
        cursor: default;
    }

    .text {
        line-height: 3rem;
    }
}

.answer-dd {
    width: 300px;
    height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    gap: 1rem;

    @include breakpoint("mobile") {
        justify-content: normal;
        align-items: flex-start
    }
}

.dragbtn {
    margin-block: 0;

    &:hover {
        cursor: grab;
    }

    &:active {
        cursor: grabbing;
    }
}

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
    height: 450px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;

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

    .help-icon button {
        background-color: $green;
        width: 30px;
        height: 30px;
        border-radius: 25px;
        border: none;
        text-align: center;
        line-height: 30px;
        color: $white;
        font-size: 1.5rem;

        &:hover {
            cursor: pointer;
        }

        svg {
            fill: $white;
        }
    }

    background-color: $background-light;
    border-radius: 25px;
    margin: 1rem;
    padding: 2rem;

    .question-main {
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 3rem;
        margin: 1rem;

        @include breakpoint("mobile") {
            flex-direction: column;
            margin: 1rem
        }

        .question {

            width: 70%;

            @include breakpoint("mobile") {
                width: auto;
            }

            h2 {
                font-size: 1.5rem;
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
                        font-size: 1.25rem;
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
}
</style>