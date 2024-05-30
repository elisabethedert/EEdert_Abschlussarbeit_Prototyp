<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <GuestLayout>

        <Head title="Welcome" />
        <header>
            <nav v-if="canLogin" class="topnav">
                <Link v-if="$page.props.auth.user" :href="route('dashboard')">
                Dashboard
                </Link>

                <template v-else>
                    <Link class="btn-text item" :href="route('login')">
                    Log in
                    </Link>

                    <Link class="btn-text item" v-if="canRegister" :href="route('register')">
                    Register
                    </Link>
                </template>
            </nav>
        </header>
        <main>
            <h1>Spielname</h1>
            <h2>Subline H2</h2>
            <h3>Big Text H3 ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                labore
                et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
                Stet
                clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</h3>

        </main>

        <footer>
            Laravel v{{ laravelVersion }} (PHP v{{ phpVersion }})
        </footer>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../css/_main.scss';

.topnav {
    background-color: $background;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    display: flex;
    justify-content: flex-end;

    .item {
        margin-top: 1rem;
        padding: 2rem 1rem 0rem 1rem;
    }
}

main {
    h1 {
        margin-top: 4rem;
    }
}
</style>
