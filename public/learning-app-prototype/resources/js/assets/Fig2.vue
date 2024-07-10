<script setup>
const props = defineProps({
    width: Number,
})
</script>

<template>
    <svg :width="width" viewBox="0 0 318 282" fill="none" xmlns="http://www.w3.org/2000/svg">
        <circle cx="227" cy="83" r="75" fill="#67917B" />
        <circle cx="111" cy="140" r="111" fill="#67917B" />
        <circle cx="227" cy="75" r="75" fill="#E3A328" />
        <circle cx="111" cy="132" r="111" fill="#E3A328" />
        <circle cx="283" cy="50" r="32.5" stroke="black" stroke-width="5" fill="#FCF9E7" />
        <circle cx="171" cy="50" r="32.5" stroke="black" stroke-width="5" fill="#FCF9E7" />
        <path d="M136 218C145.333 227.667 161.7 253.4 152.5 279C155.167 275.333 161.9 270.2 167.5 279" stroke="black"
            stroke-width="5" stroke-linecap="round" />
        <path d="M85.5 218C76.1667 227.667 59.8 253.4 69 279C66.3333 275.333 59.6 270.2 54 279" stroke="black"
            stroke-width="5" stroke-linecap="round" />
    </svg>
</template>

<style scoped lang="scss"></style>