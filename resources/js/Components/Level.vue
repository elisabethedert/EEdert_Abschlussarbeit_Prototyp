<script setup>
defineProps({
    level: {
        type: Number,
    },
});
</script>

<template>
    <div class="level">
        <p>Herausforderung:</p>
        <svg v-if="level === 1" width="73" height="21" viewBox="0 0 73 21" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <desc>Drei farbige kleine Kreise, die die Herausforderung als 1 von3 markieren</desc>
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 0 20.4758)" fill="#103A51" />
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 26.7383 20.4758)"
                fill="#D9D9D9" />
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 53.4756 20.4758)"
                fill="#D9D9D9" />
        </svg>
        <svg v-if="level === 2" width="73" height="21" viewBox="0 0 73 21" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <desc>Drei farbige kleine Kreise, die die Herausforderung als 2 von3 markieren</desc>
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 0 20.4758)" fill="#103A51" />
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 26.7383 20.4758)"
                fill="#103A51" />
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 53.4756 20.4758)"
                fill="#D9D9D9" />
        </svg>
        <svg v-if="level === 3" width="73" height="21" viewBox="0 0 73 21" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <desc>Drei farbige kleine Kreise, die die Herausforderung als 3 von3 markieren</desc>
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 0 20.4758)" fill="#103A51" />
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 26.7383 20.4758)"
                fill="#103A51" />
            <ellipse cx="9.7621" cy="10" rx="9.7621" ry="10" transform="matrix(1 0 0 -1 53.4756 20.4758)"
                fill="#103A51" />
        </svg>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.level {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-top: 0.5rem;

    svg {
        margin-top: 0.5rem;
    }
}
</style>