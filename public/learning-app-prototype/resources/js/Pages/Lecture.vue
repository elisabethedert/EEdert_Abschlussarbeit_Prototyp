<style scoped>
@import '../../css/_main.scss';
</style>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, router } from '@inertiajs/vue3';
import { ref, computed, onMounted } from 'vue';
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

const selectedAnswer = ref(null)
const result = ref(0)

const currentQuestion = computed(() => {
    if (props.questions[currentIndex.value].type === 'dd') {
        splitString(props.questions[currentIndex.value].question);
    }
    console.log("computed:")
    console.log(props.questions[currentIndex.value])
    return props.questions[currentIndex.value]
})

const isLastQuestion = computed(() => currentIndex.value === props.questions.length - 1)

const answers = computed(() => {
    return props.questions[currentIndex.value].multiple_choice_answers
})

const answersDd = computed(() => {
    const blanks = props.questions[currentIndex.value].blanks;
    
    // Regex, um die Begriffe in Anführungszeichen zu erkennen
    const matches = blanks.match(/"([^"]+)"/g);
    
    if (matches) {
        // Anführungsstriche entfernen und leere Wörter filtern
        const newWordsArray = matches.map(match => match.replace(/"/g, '')).filter(word => word !== '');
        console.log(newWordsArray);
        return newWordsArray;
    } else {
        return [];
    }
});

var count = 0;

function selectedOption(index) {
    selectedAnswer.value = index
}
function hideResult() {
    resultCorrect.value = false;
    resultIncorrect.value = false;
}

function saveMcResult() {
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

function saveDdResult() {
    console.log("dDanswers:")
    console.log(answersDd.value[0])
    console.log(answersDd.value[1])
    const droppedButtons = ref([]);
    droppedButtons.value = Array.from(document.querySelectorAll('.dragbtn')).map(button => button.textContent);
    console.log("droppedButtons:");
    console.log(droppedButtons.value[0]);
    console.log(droppedButtons.value[1]);


    // TODO korrekte Datenweiterletung an BE
    axios.post('/question_results', {
        user_id: page.props.auth.user.id,
        question_id: props.questions[currentIndex.value].id,
        //
        dropped_buttons: droppedButtons.value,
        //
        question_type: props.questions[currentIndex.value].type,
        lecture: props.questions[currentIndex.value].lecture,
        unit: props.questions[currentIndex.value].unit,
    }).then(response => {
        console.log(response.data.message);
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


function nextQuestion() {
    setTimeout(hideResult, 2000);
    if (props.questions[currentIndex.value].type === "mc") {
        saveMcResult();
        selectedAnswer.value = null;
    } else if (props.questions[currentIndex.value].type === "dd") {
        saveDdResult();
        console.log("saveResult DD");
        sentenceParts.value = [];
        console.log(answersDd)
    }
    currentIndex.value++;

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
        console.log("saveResult DD");
        sentenceParts.value = [];
        console.log(answersDd)
    }
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
    const targetElement = document.getElementById(`div${gapIndex}`);
    const draggedElement = document.getElementById(data);

    if (targetElement && draggedElement) {
        // Prüfen ob der Zielbereich bereits ein Element enthält
        if (dropTargets.value[`div${gapIndex}`]) {
            const existingElement = dropTargets.value[`div${gapIndex}`];
            // Entfernen des existierenden Elements aus dem Zielbereich
            if (existingElement.parentElement === targetElement) {
                targetElement.removeChild(existingElement);
            }
            // Zurücksetzen des existierenden Elements in den ursprünglichen Container
            draggedItem.value.originalContainer.appendChild(existingElement);
        }

        // Füge das neue Element hinzu und entferne es aus der ursprünglichen Liste
        targetElement.appendChild(draggedElement);
        answersDd.value = answersDd.value.filter(item => item !== draggedElement.textContent);

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
        event.target.appendChild(draggedElement);
        answersDd.value.push(draggedElement.textContent);
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
            <!-- MC Section -->
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
            <!-- DD Section -->
            <div v-if="currentQuestion.type === 'dd'" class="question-counter">
                <div class="question-main">
                    <div class="question">
                        <template v-for="(part, index) in sentenceParts" :key="index">
                            <span v-if="isGap(part)" class="dropbox" :id="'div' + gapIndex(index)"
                                @drop="drop($event, gapIndex(index))" @dragover="allowDrop">
                            </span>
                            <span v-else>{{ part }}</span>
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

            <div class="question-footer">
                <div v-if="resultCorrect">
                    Resuuuuult richtig
                </div>
                <div v-if="resultIncorrect">
                    Resuuuuult falsch
                </div>
                <button @click="nextQuestion" v-if="!isLastQuestion" class="btn btn-green">Bestätigen</button>
                <button @click="calculateResult" v-if="isLastQuestion" class="btn btn-yellow">Lektion beenden</button>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.dropbox {
    height: 55px;
    border-radius: 50px;
    border: none;
    text-decoration: none;
    background: $grey-light;
    color: transparent;
    display: flex;
    justify-content: center;
    align-items: center;
}

.question span {
    font-size: 2rem;
    color: $blue;
    font-weight: bold;
}

.answer-dd {
    width: 300px;
    height: 300px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;

    @include breakpoint("mobile") {
        justify-content: normal;
        align-items: flex-start
    }
}

.dragbtn {
    margin-block: 10px;

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
        justify-content: space-between;
        gap: 3rem;
        margin: 1rem;

        @include breakpoint("mobile") {
            flex-direction: column;
            margin: 1rem
        }

        .question {
            width: 40%;

            @include breakpoint("mobile") {
                width: auto;
            }

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