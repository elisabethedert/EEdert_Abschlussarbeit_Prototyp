<script setup>
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
        <div class="form-container">
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
                        class="mt-1 block w-full"
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
                        class="mt-1 block w-full"
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
                        Register
                    </PrimaryButton>
                </div>
            </form>      
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';
</style>