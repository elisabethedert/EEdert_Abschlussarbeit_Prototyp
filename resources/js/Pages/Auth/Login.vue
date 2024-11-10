<script setup>
import Footer from '@/Layouts/Footer.vue';
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import ShowPassword from '@/Components/ShowPassword.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout class="layout-center">

        <Head title="Log in" />
        <h1>Einloggen</h1>
        <div v-if="status">
            {{ status }}
        </div>
        <div class="form-container unauth">
            <form @submit.prevent="submit">
                <div class="input-container">
                    <InputLabel for="email" value="Email:" />

                    <TextInput id="email" type="email" v-model="form.email" required autofocus
                        autocomplete="username" />

                    <InputError class="error-msg" :message="form.errors.email" />
                </div>

                <div class="input-container">
                    <InputLabel for="password" value="Passwort:" />

                    <TextInput id="password" type="password" v-model="form.password" required
                        autocomplete="current-password" />
                    <ShowPassword />
                    <InputError class="error-msg" :message="form.errors.password" />
                </div>

                <div>
                    <label class="remember-container">
                        <Checkbox name="remember" v-model:checked="form.remember" />
                        <span class="remember-check">Angemeldet bleiben</span>
                    </label>
                </div>

                <div class="submit">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="btn-text link">
                    Passwort vergessen?
                    </Link>

                    <PrimaryButton :disabled="form.processing">
                        Log in
                    </PrimaryButton>

                    <Link class="btn btn-green" :href="route('register')">
                    Neues Konto erstellen
                    </Link>
                </div>
            </form>
        </div>
        <Link class="btn btn-text back" href="/">
        Zurück
        </Link>
    </GuestLayout>
    <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

h1 {
    @include breakpoint("mobile") {
        margin-block: 3rem;
    }
}

.back {
    margin-left: 25%;
    padding-left: 2rem;

    @include breakpoint("mobile") {
        margin-left: 0;
        padding-left: 1rem;
    }
}

.footer {
    padding-top: 4rem;

    p {
        padding: 0.25rem;
        color: white;
    }
}
</style>