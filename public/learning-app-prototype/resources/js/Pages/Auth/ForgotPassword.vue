<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <GuestLayout class="layout-center">
        <Head title="Forgot Password" />
        <h1>Passwort vergessen</h1>
        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>
        <div class="form-container">

            <p class="info-text">
                Du hast dein Passwort vergessen? Kein Problem, wir schicken dir einen Link über den du dein Passwort
                zurücksetzen kannst.
            </p>
            <form @submit.prevent="submit">
                <div class="input-container">
                    <InputLabel for="email" value="Email:" />

                    <TextInput id="email" type="email" v-model="form.email" required autofocus autocomplete="username" />

                    <InputError class="error-msg" :message="form.errors.email" />
                </div>
                <div class="submit">

                    <PrimaryButton :disabled="form.processing">
                        Passwort zurücksetzen
                    </PrimaryButton>
                    <Link class="btn btn-green" :href="route('login')">
                    Zurück
                    </Link>
                </div>
            </form>
        </div>
    </GuestLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';
</style>
