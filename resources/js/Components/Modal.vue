<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    closeable: {
        type: Boolean,
        default: true,
    },
});

const emit = defineEmits(['close']);

watch(
    () => props.show,
    () => {
        if (props.show) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = null;
        }
    }
);

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

</script>

<template>
    <Teleport to="body">
        <div v-show="show" class="modal" scroll-region>
            <div v-show="show" class="modal-container">
                <slot v-if="show" />
            </div>
        </div>
    </Teleport>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.modal {
    position: absolute;
    background: $background;
    left: 0;
    right: 0;
    margin: 0 auto;

    &-container {
        padding: 2rem;
        margin: 2rem;
        background-color: $background-light;
        border: solid 3px $yellow;
        border-radius: 25px;
    }

}
</style>
