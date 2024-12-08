<script setup>
// inspired by William Juma - Laraphant, W3Schools, ChatGPT

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import AnimationContainer from '@/Components/Animations/AnimationContainer.vue';
import HappyDance from '@/Components/Animations/HappyDance.vue';
import SadDance from '@/Components/Animations/SadDance.vue';
import HelpPopup from '@/Components/HelpPopup.vue';
import Arrow from '@/Assets/Arrow.vue';
import Info from '@/Assets/Info.vue';
import Cross from '@/Assets/Cross.vue';
import Tick from '@/Assets/Tick.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';

const props = defineProps({
    questions: Object
})

const lectureQuestionCount = props.questions.length;
const lecureQuestionRepeatCount = ref(0);
const currentSession = crypto.randomUUID();

const isPopupVisible = ref(false);

const currentIndex = ref(0);
const resultFirstCorrect = ref(false);
const resultRepeatCorrect = ref(false);
const resultRepeatSessionCorrect = ref(false);
const resultIncorrect = ref(false);

const selectedAnswer = ref(null)
const result = ref(0)

const showQuestion = ref(true);

var count = 0;

const sentenceParts = ref([]);
const draggedItem = ref(null);
const dropTargets = ref({});

/**
 * get the current question
 * @returns {Object} current question
 */
const currentQuestion = computed(() => {
    if (props.questions[currentIndex.value].type === 'dd') {
        splitString(props.questions[currentIndex.value].question);
    }
    return props.questions[currentIndex.value]
})

/**
 * check if the current question is the last question
 */
const isLastQuestion = computed(() => currentIndex.value === props.questions.length - 1)

/**
 * get the current answers
 * @returns {Array} current answers
 */
const answers = computed(() => {
    return props.questions[currentIndex.value].answers
})


/**
 * show or hide the help popup containing information about processing
 */
function showHelpPopup() {
    if (isPopupVisible.value) {
        isPopupVisible.value = false;
    } else {
        isPopupVisible.value = true;
    }
}

/**
 * set the selected answer
 * @param index of the selected answer
 */
function selectedOption(index) {
    selectedAnswer.value = index
}

/**
 * hide the result with animation
 */
function hideResult() {
    resultFirstCorrect.value = false;
    resultRepeatCorrect.value = false;
    resultRepeatSessionCorrect.value = false;
    resultIncorrect.value = false;
    showQuestion.value = true;
}

/**
 * save the result of the mc question with axios and get response about the evluation of that questionresult
 */
function saveMcResult() {
    axios.post('/question_results', {
        question_id: props.questions[currentIndex.value].id,
        answer_id: props.questions[currentIndex.value].answers[selectedAnswer.value].id,
        question_type: props.questions[currentIndex.value].type,
        lecture: props.questions[currentIndex.value].lecture,
        unit: props.questions[currentIndex.value].unit,
        session: currentSession
    }).then(response => {
        if (response.data.message == "firstcorrect") {
            result.value++;
            resultFirstCorrect.value = true;
        } else if (response.data.message == "repeatcorrect") {
            result.value++;
            resultRepeatCorrect.value = true;
        } else if (response.data.message == "repeatsessioncorrect") {
            result.value++;
            resultRepeatSessionCorrect.value = true;
        } else {
            resultIncorrect.value = true;
            // add wrong answered question to the end of the questions array
            lecureQuestionRepeatCount.value++;
            props.questions.push(props.questions[currentIndex.value - 1]);
        }
    }).catch(error => {
        console.error(error);
    });
}

/**
 * save the result of the dd question with axios and get response about the evluation of that questionresult
 */
function saveDdResult() {
    // contains the order of the dropped buttons
    const droppedButtons = ref([]);
    droppedButtons.value = Array.from(document.querySelectorAll('.dropbox button')).map(button => button.textContent);

    axios.post('/question_results', {
        question_id: props.questions[currentIndex.value].id,
        dropped_buttons: droppedButtons.value,
        question_type: props.questions[currentIndex.value].type,
        lecture: props.questions[currentIndex.value].lecture,
        unit: props.questions[currentIndex.value].unit,
        session: currentSession
    }).then(response => {
        if (response.data.message == "firstcorrect") {
            result.value++;
            resultFirstCorrect.value = true;
        } else if (response.data.message == "repeatcorrect") {
            result.value++;
            resultRepeatCorrect.value = true;
        } else if (response.data.message == "repeatsessioncorrect") {
            result.value++;
            resultRepeatSessionCorrect.value = true;
        } else {
            resultIncorrect.value = true;
            // add wrong answered question to the end of the questions array
            lecureQuestionRepeatCount.value++;
            props.questions.push(props.questions[currentIndex.value - 1]);
        }
    }).catch(error => {
        console.error(error);
    });
}

/**
 * check if any dropboxes are empty
 * @returns {boolean} true if any dropbox is empty
 */
function dropboxEmpty() {
    const dropboxes = document.querySelectorAll('.dropbox');
    for (let dropbox of dropboxes) {
        if (dropbox.children.length === 0) {
            return true
        }
    }
    return false
}

/**
 * show the next question and call save methods for current question
 */
function nextQuestion() {
    // check if current question is completed
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

    // check if there are associated buttons in dropbox spans and clear them
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

    progressbar();
}

/**
 * call the result page and save the last question
 */
function calculateResult() {
    progressbar();

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

/**
 * progressbar 
 */
function progressbar() {
    count = count === maxCount ? maxCount : count + 1;
    var maxCount = lectureQuestionCount;
    var newWidth = (count / maxCount) * 100 + "%";
    document.getElementsByClassName("progress-bar")[0].style.width = newWidth;
}

/**
 * check if the part is a gap
 * @param {string} part of the question
 * @returns {boolean} true if the part is a gap
 */
function isGap(part) {
    // true if the part is a gap
    return /^___+$/.test(part.trim());
};

/**
 * calculates the number of ‘gaps’ (elements containing three underscores) 
   in the `sentenceParts.value` array up to a specified index
 * @param {number} index of the part
 * @returns {number} number of gaps
 */
const gapIndex = (index) => {
    return sentenceParts.value.slice(0, index).filter(isGap).length;
};

/**
 * split the question string into parts
 * @param {string} currentQ current question
 */
function splitString(currentQ) {
    // regex detects underscores in the string
    const regex = /(_{3})(?=[,.\s]|$)/g
    let parts = currentQ.split(regex);

    // remove empty parts from the parts array
    parts = parts.filter(part => part !== undefined && part !== "");
    for (let i = 0; i < parts.length; i++) {
        sentenceParts.value.push(parts[i]);
    }
};

/**
 * allow drop event
 * @param event 
 */
function allowDrop(event) {
    event.preventDefault();
}

/**
 * allow drag event
 * @param event 
 */
function drag(event) {
    draggedItem.value = {
        id: event.target.id,
        originalContainer: event.target.parentElement
    };
    event.dataTransfer.setData("text", event.target.id);
}

/**
 * handle drop events and the content of elements with drop functionality
 * @param event
 * @param {number} gapIndex index of the target gap
 */
function drop(event, gapIndex) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const targetElement = document.getElementById(`div${gapIndex}`); // div class="dropbox"
    const draggedElement = document.getElementById(data);

    // check if the target element is empty, else dropping is not possible
    if (targetElement && draggedElement) {
        if (targetElement.children.length > 0) {
            return;
        }

        // if the dragged element is from one gap to another, 
        // write the underscores back to the item
        if (draggedItem.value.originalContainer.className !== "answer-dd") {
            draggedItem.value.originalContainer.innerText = '_____'
        }

        // remove underscores from gap
        targetElement.textContent = '';

        // add the new element and remove it from the original list
        targetElement.appendChild(draggedElement);
        targetElement.insertBefore(draggedElement, targetElement.firstChild);

        // update the dropTargets entry
        dropTargets.value[`div${gapIndex}`] = draggedElement;
    }
}

/**
 * handling of drop events back to the answer-dd div
 * @param event
 */
function dropToAnswerDD(event) {
    event.preventDefault();
    const data = event.dataTransfer.getData("text");
    const draggedElement = document.getElementById(data);

    if (draggedElement && draggedItem.value.originalContainer.className !== "answer-dd") {
        // find the gap index of the dragged element 
        // and remove it from the dropTargets
        const gapIndexKey = Object.keys(dropTargets.value).find(key => dropTargets.value[key] === draggedElement);
        if (gapIndexKey) {
            dropTargets.value[gapIndexKey] = null;
        }

        // write the underscores back to the item
        draggedItem.value.originalContainer.innerText = '_____';

        // remove the dragged element from the gap and add it back to the answer-dd div
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
                    <p v-if="currentIndex + 1 <= lectureQuestionCount" class="question-counter"><b>Frage {{ currentIndex
                        +
                            1 }} von {{ lectureQuestionCount }}</b> | +
                        {{ lecureQuestionRepeatCount }} Fragen zur Wiederholung</p>
                    <p v-else class="question-counter">Frage {{ lectureQuestionCount }} von {{ lectureQuestionCount }}
                        <Tick class="ticked" /> |
                        <b> Wiederholungsfrage {{ currentIndex + 1 - lectureQuestionCount }} / {{
                            lecureQuestionRepeatCount }}</b>
                    </p>
                    <div class="progress">
                        <div class="progress-bar">
                            <span style="width: 40%;"></span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MC Section -->
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
                                    <span class="answer-text">
                                        {{ answer.answer }}
                                    </span>
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
                                    @drop="drop($event, gapIndex(index))" @dragover="allowDrop">_____
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
                <!-- Animations -->
                <div class="question-animation">
                    <div v-if="resultFirstCorrect">
                        <AnimationContainer :showXp="true" :xp="3">
                            <template #result>
                                <h3>Richtig!</h3>
                            </template>
                            <template #figure>
                                <HappyDance />
                            </template>
                        </AnimationContainer>
                    </div>
                    <div v-if="resultRepeatCorrect">
                        <AnimationContainer :showXp="true" :xp="1">
                            <template #result>
                                <h3>Richtig!</h3>
                            </template>
                            <template #figure>
                                <HappyDance />
                            </template>
                        </AnimationContainer>
                    </div>
                    <div v-if="resultRepeatSessionCorrect">
                        <AnimationContainer :showXp="false">
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
                <!-- Buttons -->
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

    @include breakpoint("mobile") {
        margin-top: 2rem;
    }

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
    margin-block: 2rem;
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

            .ticked {
                margin-bottom: -5px;
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
                gap: 0rem;
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
                        line-height: 2.5rem;
                        font-size: 1.25rem;
                    }
                }

                .dropbox {
                    border: none;
                    text-decoration: none;
                    display: inline-block;

                    @include breakpoint("mobile") {
                        line-height: 3rem;
                    }
                }
            }

            .answers-mc {
                width: 60%;
                display: flex;
                flex-direction: column;
                gap: 1rem;

                @include breakpoint("mobile") {
                    width: 100%;
                }

                .question h2 {
                    text-align: left !important;
                }

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
                    min-height: 80px;
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
        margin-top: 0rem;
        justify-content: center;
    }

}
</style>