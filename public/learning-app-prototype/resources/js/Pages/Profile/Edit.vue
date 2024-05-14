<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import UpdateProfileInformationForm from './Partials/UpdateProfileInformationForm.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    mustVerifyEmail: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});
</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
        </template>

        <div class="py-12">
            <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> -->
            <div class="input">
                <div class="input-container">
                    <UpdateProfileInformationForm
                        :must-verify-email="mustVerifyEmail"
                        :status="status"
                        class="max-w-xl"
                    />
                </div>

                <div class="input-container">
                    <UpdatePasswordForm class="max-w-xl" />
                </div>

                <div class="input-container">
                    <DeleteUserForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<style scoped lang="scss">
@import '../../../css/_main.scss';

.input {
    margin-left: auto;
    margin-right: auto;
    --space-y-reverse: 0;
    margin-top: calc(1.5rem * calc(1 - var(--space-y-reverse)));
    margin-bottom: calc(1.5rem * var(--space-y-reverse));
}
.input-container {
    padding: 2rem;
    background: $white;
    box-shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
    border-radius: 10px;
}
</style>

