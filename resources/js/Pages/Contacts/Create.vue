<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Link, Head, useForm} from '@inertiajs/vue3'

defineProps({
    accounts: Array,
});

const form = useForm({
    first_name: "",
    last_name: "",
    email: "",
    phone: "",
    position: "",
    account_id: "",
});

const submit = async () => {
    try {
        form.post(route("contacts.store"));
    } catch (error) {
        console.error(error);
    }
};
</script>

<template>
    <Head title="Create Account" />

    <BreezeAuthenticatedLayout>
        <div class="max-w-screen-lg mx-auto my-6 space-y-6">
            <div class="bg-white shadow px-4 py-5 sm:rounded-lg sm:p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <h3 class="text-lg font-medium leading-6 text-gray-900">Contact Information</h3>
                        <ul class="mt-6">
                            <li
                                class="text-red-500"
                                v-for="(error, index) in form.errors"
                                :key="index"
                            >
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <form @submit.prevent="submit">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-3">
                                    <label for="first-name" class="block text-sm font-medium text-gray-700">First Name</label>
                                    <input
                                        type="text"
                                        id="first-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.first_name"
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
                                    <input
                                        type="text"
                                        id="last-name"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.last_name"
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input
                                        type="email"
                                        id="email"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.email"
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                    <input
                                        type="tel"
                                        id="phone"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.phone"
                                    >
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="position" class="block text-sm font-medium text-gray-700">Position</label>
                                    <input
                                        type="text"
                                        id="position"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                        v-model="form.position"
                                    >
                                </div>

                                <div class="col-span-6">
                                    <label for="account" class="block text-sm font-medium text-gray-700">Account</label>
                                    <select
                                        id="account"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                        v-model="form.account_id"
                                    >
                                        <option value="" disabled>Select an account</option>
                                        <option
                                            v-for="account in accounts"
                                            :key="account.id"
                                            :value="account.id"
                                        >
                                            {{ account.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex justify-end mt-6">
                                <Link
                                    :href="route('contacts.index')"
                                    class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Cancel
                                </Link>
                                <button
                                    type="submit"
                                    class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                >
                                    Create
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>