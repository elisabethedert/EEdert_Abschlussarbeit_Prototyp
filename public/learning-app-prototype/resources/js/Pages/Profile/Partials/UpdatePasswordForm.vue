<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.put(route('password.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.password) {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.current_password) {
                form.reset('current_password');
                currentPasswordInput.value.focus();
            }
        },
    });
};
</script>

<template>
    <section>
        <div class="form-container auth">
            <h2>Passwort aktualisieren</h2>

            <p class="description">
                Stelle sicher, dass dein Konto ein langes, zufälliges Passwort verwendet, um sicher zu sein.
            </p>
        <form @submit.prevent="updatePassword">
            <div class="input-container">
                <InputLabel for="current_password" value="Aktuelles Password:" />

                <TextInput
                    id="current_password"
                    ref="currentPasswordInput"
                    v-model="form.current_password"
                    type="password"
                    autocomplete="current-password"
                />

                <InputError :message="form.errors.current_password" class="error-msg" />
            </div>

            <div class="input-container">
                <InputLabel for="password" value="Neues Passwort:" />

                <TextInput
                    id="password"
                    ref="passwordInput"
                    v-model="form.password"
                    type="password"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password" class="error-msg" />
            </div>

            <div class="input-container">
                <InputLabel for="password_confirmation" value="Password wiederholen:" />

                <TextInput
                    id="password_confirmation"
                    v-model="form.password_confirmation"
                    type="password"
                    autocomplete="new-password"
                />

                <InputError :message="form.errors.password_confirmation" class="error-msg" />
            </div>

            <div>
                <p v-if="form.recentlySuccessful" class="description-big">Erfolgreich aktualisiert!</p>
                <PrimaryButton :disabled="form.processing">Speichern</PrimaryButton>
            </div>
        </form>
    </div>
    </section>
</template>

<style scoped lang="scss">
@import '../../../../css/_main.scss';
</style>
