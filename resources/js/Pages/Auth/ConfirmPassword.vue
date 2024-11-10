<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('password.confirm'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <GuestLayout class="layout-center">
        <Head title="Confirm Password" />
        <h1>Passwort bestätigen</h1>
        <p class="info-text">
            Bitte bestätige zunächst dein Passwort
        </p>

        <form @submit.prevent="submit">
            <div class="input-container">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                    autofocus
                />
                <InputError class="error-msg" :message="form.errors.password" />
            </div>

            <div class="submit">
                <PrimaryButton :disabled="form.processing">
                    Bestätigen
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';
</style>