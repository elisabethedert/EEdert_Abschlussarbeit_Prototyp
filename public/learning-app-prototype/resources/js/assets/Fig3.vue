<script setup>
const props = defineProps({
    width: Number,
})
</script>

<template>
    <svg class="fig3" :width="width" viewBox="0 0 242 435" fill="none" xmlns="http://www.w3.org/2000/svg">
        <desc>Eine Figur bestehend aus Beinen drei Kreisen und Kulleraugen</desc>
        <circle cx="75" cy="204" r="75" fill="#67917B" />
        <circle cx="151" cy="83" r="75" fill="#67917B" />
        <circle cx="150" cy="325" r="75" fill="#67917B" />
        <circle cx="75" cy="196" r="75" fill="#E3A328" />
        <circle cx="151" cy="75" r="75" fill="#E3A328" />
        <circle cx="150" cy="317" r="75" fill="#E3A328" />
        <circle cx="95" cy="50" r="32.5" stroke="black" stroke-width="5" fill="#FCF9E7" />
        <circle cx="207" cy="50" r="32.5" stroke="black" stroke-width="5" fill="#FCF9E7" />
        <path d="M175 371C184.333 380.667 200.7 406.4 191.5 432C194.167 428.333 200.9 423.2 206.5 432" stroke="black"
            stroke-width="5" stroke-linecap="round" />
        <path d="M124.5 371C115.167 380.667 98.8 406.4 108 432C105.333 428.333 98.6 423.2 93 432" stroke="black"
            stroke-width="5" stroke-linecap="round" />
    </svg>
</template>

<style scoped lang="scss">
.fig3 {
    min-width: 50px;
}
</style>