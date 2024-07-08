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
import Info from '@/assets/Info.vue';
import Cross from '@/assets/Cross.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';


const currentSession = crypto.randomUUID();

const props = defineProps({
    questions: Object
})

const lectureQuestionCount = props.questions.length;
const lecureQuestionRepeatCount = ref(0);

const isPopupVisible = ref(false);

function showHelpPopup() {
    if (isPopupVisible.value) {
        isPopupVisible.value = false;
    } else {
        isPopupVisible.value = true;
    }
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
    return props.questions[currentIndex.value].answers
})

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
        answer_id: props.questions[currentIndex.value].answers[selectedAnswer.value].id,
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
            // add wrong answered question to the end of the questions array
            lecureQuestionRepeatCount.value++;
            props.questions.push(props.questions[currentIndex.value]);
        }
    }).catch(error => {
        console.error(error);
    });
}

function saveDdResult() {

    const droppedButtons = ref([]);
    droppedButtons.value = Array.from(document.querySelectorAll('.dropbox button')).map(button => button.textContent);
    // TODO korrekte Datenweiterletung an BE
    axios.post('/question_results', {
        question_id: props.questions[currentIndex.value].id,
        dropped_buttons: droppedButtons.value,
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
            // add wrong answered question to the end of the questions array
            lecureQuestionRepeatCount.value++;
            props.questions.push(props.questions[currentIndex.value]);
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
    if (props.questions[currentIndex.value].type === "mc") {
        saveMcResult();
        selectedAnswer.value = null;
    } else if (props.questions[currentIndex.value].type === "dd") {
        saveDdResult();
        sentenceParts.value = [];
    }
    showQuestion.value = false;
    setTimeout(hideResult, 2100);
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
    var maxCount = lectureQuestionCount;
    count = count === maxCount ? maxCount : count + 1;
    progressbar(count, maxCount);
}

function calculateResult() {
    setTimeout(hideResult, 4000);
    showQuestion.value = false;
    if (props.questions[currentIndex.value].type === "mc") {
        saveMcResult();
        selectedAnswer.value = null;
    } else if (props.questions[currentIndex.value].type === "dd") {
        saveDdResult();
        sentenceParts.value = [];
    }
    setTimeout(() => {
        router.get(`/unit1/lektion${props.questions[currentIndex.value].lecture}/result${currentSession}`);
    }, 2000);
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
        // targetElement.textContent = '';

        // Füge das neue Element hinzu und entferne es aus der ursprünglichen Liste
        targetElement.appendChild(draggedElement);
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

</script>

<template>

    <Head title="Spiel" />

    <AuthenticatedLayout>
        <div class="info-header">
            <h1>Unit {{ currentQuestion.unit }} - Lektion {{ currentQuestion.lecture }}</h1>
            <h2>{{ currentQuestion.topic }}</h2>
        </div>

        <div class="question-container">
            <div class="help-icon">
                <button @click="showHelpPopup">
                    <Info v-if="!isPopupVisible" />
                    <Cross v-if="isPopupVisible" />
                </button>
                <HelpPopup :visible="isPopupVisible" @showhelp="isPopupVisible = $event">
                    <p v-if="currentQuestion.type === 'mc'"><b>Tipp:</b> Wähle die richtige Antwort aus</p>
                    <p v-if="currentQuestion.type === 'dd'"><b>Tipp:</b> Ziehe die gelben Buttons in die Lücke</p>
                </HelpPopup>
            </div>
            <div class="question-header">
                <div class="question-counter">
                    <p class="question-counter"><b>Frage {{ currentIndex + 1 }} von {{ lectureQuestionCount }}</b> | +{{
                        lecureQuestionRepeatCount }} Fragen zur Wiederholung</p>
                    <div class="progress">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MC Section -->
            <!-- <MultipleChoice/> -->
            <div class="content">
                <div v-if="currentQuestion.type === 'mc'">
                    <div class="question-main" v-if="showQuestion">
                        <div class="question">
                            <div class="">
                                <h2>{{ currentQuestion.question }}</h2>
                            </div>
                        </div>
                        <div class="answers-mc">
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
                                    @drop="drop($event, gapIndex(index))" @dragover="allowDrop">__
                                </span>
                                <span class="text" v-else>{{ part }}</span>
                            </template>
                        </div>
                        <div class="answer-dd" @drop="dropToAnswerDD" @dragover="allowDrop">
                            <button v-for="(item, index) in answers" :key="index" class="dragbtn btn btn-yellow"
                                :id="'drag' + index" draggable="true" @dragstart="drag($event, index)">
                                {{ item.answer }}
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
    min-height: 450px;
    margin-top: 2rem;
    padding: 2rem;
    background-color: $background-light;
    border-radius: 25px;

    @include breakpoint("mobile") {
        padding: 1rem;
    }

    .question-header {
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
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
        height: 40px;

        button {
            background-color: $green;
            min-width: 32px;
            height: 32px;
            margin-right: 5px;
            border-radius: 25px;
            border: none;
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
    }

    .content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;




        .question-main {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            gap: 3rem;
            margin: 1rem;

            @include breakpoint("mobile") {
                flex-direction: column;
                margin: 1rem;
                gap: 1rem;
            }

            .question {
                h2 {
                    font-size: 1.5rem;
                }

                @include breakpoint("mobile") {
                    width: auto;
                }
            }

            .question {
                span {
                    line-height: 0;
                    height: 20px;
                    width: auto;
                    font-size: 1.5rem;
                    color: $blue;
                    font-weight: bold;
                }

                &:hover {
                    cursor: default;
                }

                .text {
                    line-height: 3rem;

                    @include breakpoint("mobile") {
                        line-height: 2rem;
                        font-size: 1.25rem;
                    }
                }

                .dropbox {
                    border: none;
                    text-decoration: none;
                    display: inline-block;
                }
            }

            .answers-mc {
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
                        min-width: 23px;
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

            .answer-dd {
                width: 300px;
                min-height: 150px;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-wrap: wrap;
                gap: 1rem;

                @include breakpoint("mobile") {
                    width: 100%;
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
            }
        }

        .question-animation {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;

            h3 {
                font-size: 1.5rem;
                color: $blue;
            }
        }
    }
}


.question-footer {
    display: flex;
    justify-content: baseline;
    align-items: baseline;
    margin-top: 1rem;

    @include breakpoint("mobile") {
        display: flex;
        margin-top: 1rem;
        justify-content: center;
    }

}
</style>