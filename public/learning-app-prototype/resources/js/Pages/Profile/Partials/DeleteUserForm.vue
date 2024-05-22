<script setup>
import DangerButton from '@/Components/DangerButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import Modal from '@/Components/Modal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { nextTick, ref } from 'vue';

const confirmingUserDeletion = ref(false);
const passwordInput = ref(null);

const form = useForm({
    password: '',
});

const confirmUserDeletion = () => {
    confirmingUserDeletion.value = true;

    nextTick(() => passwordInput.value.focus());
};

const deleteUser = () => {
    form.delete(route('profile.destroy'), {
        preserveScroll: true,
        onSuccess: () => closeModal(),
        onError: () => passwordInput.value.focus(),
        onFinish: () => form.reset(),
    });
};

const closeModal = () => {
    confirmingUserDeletion.value = false;

    form.reset();
};
</script>

<template>
    <section>
        <div class="form-container auth">
            <h2>Account löschen</h2>

            <p class="description">
                Sobald dein Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht. Vor der Löschung deines
                Kontos lade bitte alle Daten und Informationen herunter, die du aufbewahren möchtest.
            </p>

            <DangerButton @click="confirmUserDeletion">Account löschen</DangerButton>

            <Modal :show="confirmingUserDeletion" @close="closeModal">
                <div>
                    <h2 class="danger">
                        Account wirklich löschen?
                    </h2>

                    <p class="description">
                        Sobald dein Konto gelöscht ist, werden alle Ressourcen und Daten dauerhaft gelöscht. Bitte gib
                        dein Passwort ein, um zu bestätigen, dass du dein Konto endgültig löschen möchtest.
                    </p>

                    <div class="input-container">
                        <InputLabel for="password" value="Passwort:" />

                        <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                            placeholder="Passwort" @keyup.enter="deleteUser" />

                        <InputError :message="form.errors.password" class="error-msg" />
                    </div>

                    <div>
                        <SecondaryButton @click="closeModal"> Abbrechen </SecondaryButton>

                        <DangerButton :disabled="form.processing" @click="deleteUser">
                            Account löschen
                        </DangerButton>
                    </div>
                </div>
            </Modal>
        </div>
    </section>
</template>

<style scoped lang="scss">
@import '../../../../css/_main.scss';

.description {
        padding-block: 1rem;
    }

.danger {
    color: $danger-red;
}
</style>
