<script setup>
import { onMounted, onUnmounted, ref } from 'vue';

const closeOnEscape = (e) => {
    if (open.value && e.key === 'Escape') {
        open.value = false;
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => document.removeEventListener('keydown', closeOnEscape));

const open = ref(false);
</script>

<template>
    <div class="dropdown">
        <div @click="open = !open">
            <slot name="trigger" />
        </div>

        <!-- Full Screen Dropdown Overlay -->
        <div v-show="open" class="dropdown-overlay" @click="open = false"></div>

        <Transition
            enter-active-class="enter-ac"
            enter-from-class="enter-fc"
            enter-to-class="enter-tc"
            leave-active-class="leave-ac"
            leave-from-class="leave-fc"
            leave-to-class="leave-tc"
        >
            <div
                v-show="open"
                class="open"
                style="display: block"
                @click="open = false"
            >
                <div class="content">
                    <slot name="content" />
                </div>
            </div>
        </Transition>
    </div>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.dropdown {
    position: relative;

    &-overlay {
        position: fixed;
        inset: 0px;
        z-index: 40;
    }

    .enter-ac{
        transition: ease-out;
        transition-duration: 200ms;
    }

    .enter-fc, .leave-tc {
        opacity: 0;
        transform: scale(0.95);
    }

    .enter-tc, .leave-fc {
        opacity: 1;
        transform: scale(1);
    }

    .leave-ac {
        transition: ease-in;
        transition-duration: 75ms;
    }

    .open {
        position: absolute;
        z-index: 50;
        margin-top: 2.5rem;
        width: auto;
        border-radius: 0.375rem;
        right: 0;

        .content {
            border-radius: 10px;
            border: 1px solid $grey;
            color: $blue;
            background: $background-light;
        }
    }
}


</style>
