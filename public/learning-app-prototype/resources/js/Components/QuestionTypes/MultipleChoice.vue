<script setup>

</script>

<template>
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
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';
</style>