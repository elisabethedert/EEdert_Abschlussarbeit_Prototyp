<script setup>
import Footer from '@/Layouts/Footer.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <GuestLayout class="layout-center">
        <Head title="Register" />
        <h1>Registrieren</h1>
        <div class="form-container unauth">
            <form @submit.prevent="submit">
                <div class="input-container">
                    <InputLabel for="name" value="Name:" />

                    <TextInput
                        id="name"
                        type="text"
                        v-model="form.name"
                        required
                        autofocus
                        autocomplete="name"
                    />

                    <InputError class="error-msg" :message="form.errors.name" />
                </div>

                <div class="input-container">
                    <InputLabel for="email" value="Email:" />

                    <TextInput
                        id="email"
                        type="email"
                        v-model="form.email"
                        required
                        autocomplete="username"
                    />

                    <InputError class="error-msg" :message="form.errors.email" />
                </div>

                <div class="input-container">
                    <InputLabel for="password" value="Passwort:" />

                    <TextInput
                        id="password"
                        type="password"
                        v-model="form.password"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="error-msg" :message="form.errors.password" />
                </div>

                <div class="input-container">
                    <InputLabel for="password_confirmation" value="Confirm Password:" />

                    <TextInput
                        id="password_confirmation"
                        type="password"
                        v-model="form.password_confirmation"
                        required
                        autocomplete="new-password"
                    />

                    <InputError class="error-msg" :message="form.errors.password_confirmation" />
                </div>

                <div class="submit">
                    <Link
                        :href="route('login')"
                        class="btn-text link"
                    >
                        Du hast ein Konto?
                    </Link>

                    <PrimaryButton :disabled="form.processing">
                        Registrieren
                    </PrimaryButton>
                </div>
            </form>      
        </div>
        <Link class="btn btn-text back" href="/">
        Zurück
        </Link>
        <Footer class="footer">
        <p>AGB</p>
        <p>Datenschutz</p>
    </Footer>
    </GuestLayout>
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