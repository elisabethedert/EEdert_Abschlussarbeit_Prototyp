<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Fig2 from '@/assets/Fig2.vue';
import Arrow from '@/assets/Arrow.vue';
import { Head, Link } from '@inertiajs/vue3';

const props = defineProps({
    sessionCount: Number
})
</script>

<template>

    <Head title="404" />

    <AuthenticatedLayout>
        <h1>404</h1>
        <h2>Scheint als hättest du dich verlaufen...</h2>

        <div class="links">
            <Fig2 class="figure" />
            <Link :href="'/units'" class="btn btn-yellow">Zur zum Dashboard
            <Arrow />
            </Link>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.figure {
    margin-block: 2rem;
}

.links {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 2rem;
}
</style>
