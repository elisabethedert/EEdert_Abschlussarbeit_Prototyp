<script setup>
</script>
<template>
    <footer>
        <div class="footer">
            <div class="bg">
                <svg width="1132" viewBox="0 0 1132 211" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <desc>Ein farbiger Kreis, der als Hintergrund für die Footer Informationen genutzt wird</desc>
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.216797 211H1131.78C980.201 79.5496 782.39 0 566 0C349.609 0 151.799 79.5496 0.216797 211Z"
                        fill="#103A51" />
                </svg>
            </div>
            <div class="text">
                <slot></slot>
            </div>
        </div>
    </footer>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.footer {
    position: relative;
    margin-top: 3rem;

    @include breakpoint('mobile') {
        margin-top: 1.5rem;
    }

    .bg {
        background: $background;
        display: flex;
        justify-content: center;
        position: relative;
    }

    .text {
        position: absolute;
        top: 80%;
        left: 50%;
        transform: translate(-50%, -50%);
        display: flex;
        justify-content: center;

        @include breakpoint('mobile') {
            top: 60%;
        }
    }
}
</style>
