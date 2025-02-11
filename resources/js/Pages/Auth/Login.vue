<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

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

// Define the canRegister variable
const canRegister = ref(true); // Set to true or false based on your application's logic
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div class="relative isolate overflow-hidden min-h-screen">
            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2830&q=80&blend=111827&sat=-100&exp=15&blend-mode=multiply" alt="" class="absolute inset-0 -z-10 h-full w-full object-cover" />
            <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
                <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
            <div class="flex min-h-full flex-1 items-center justify-center px-4 py-12 sm:px-6 lg:px-8">
                <div class="w-full max-w-sm space-y-10">
                    <div>
                        <ApplicationLogo class="w-auto h-12 justify-center" />Technology
                        <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-accent">Sign in to your account</h2>
                    </div>
                    <form @submit.prevent="submit" class="space-y-6">
                        <div>
                            <div class="col-span-2">
                                <InputLabel for="email" value="Email" />
                                <TextInput
                                    id="email"
                                    type="email"
                                    class="block w-full rounded-t-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:relative focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-accent sm:text-sm/6"
                                    v-model="form.email"
                                    required
                                    autofocus
                                    autocomplete="username"
                                    placeholder="Email address"
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>
                            <div class="-mt-px">
                                <InputLabel for="password" value="Password" />
                                <TextInput
                                    id="password"
                                    type="password"
                                    class="block w-full rounded-b-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:relative focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-accent sm:text-sm/6"
                                    v-model="form.password"
                                    required
                                    autocomplete="current-password"
                                    placeholder="Password"
                                />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <div class="flex gap-3">
                                <div class="flex h-6 shrink-0 items-center">
                                    <Checkbox name="remember" v-model:checked="form.remember" />
                                </div>
                                <label for="remember-me" class="block text-sm/6 text-gray-900">Remember me</label>
                            </div>

                            <div class="text-sm/6">
                                <Link
                                    v-if="canResetPassword"
                                    :href="route('password.request')"
                                    class="font-semibold text-accent hover:text-accent-500"
                                >
                                    Forgot password?
                                </Link>
                            </div>
                        </div>

                        <div>
                            <PrimaryButton
                                class="flex w-full justify-center rounded-md bg-accent px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-accent focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
                                :class="{ 'opacity-25': form.processing }"
                                :disabled="form.processing"
                            >
                                Sign in
                            </PrimaryButton>
                        </div>
                    </form>

                    
                        
                        <div>
            <Link
              v-if="canRegister"
              :href="route('register')"
              class="rounded-md px-3 py-2 text-accent ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-accent dark:hover:text-accent dark:focus-visible:ring-white"
            >
              Not Registered?
            </Link>
          </div>
                </div>
            </div>
            <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
                <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-20 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)" />
            </div>
        </div>
    </GuestLayout>
</template>

<style scoped>
/* Add any styles you need here */
</style>