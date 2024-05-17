<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input class="text-input" v-model="model" ref="input" />
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.text-input {
    background: $white;
    border: 1px solid $grey;
    border-radius: 10px;
    font-size: large;
    color: $blue;
    height: 2rem;
    padding-left: 1rem;
    margin-bottom: 1rem;

    &:focus {
        border: 1px solid $blue;
    }
}
</style>