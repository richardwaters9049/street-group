<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
</script>

<template>
    <!-- Setting the page title -->
    <Head title="Dashboard" />

    <!-- Using AuthenticatedLayout as the main layout component -->
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-800 mb-10">
                        <!-- Title for the dashboard -->
                        <h1
                            class="text-4xl font-bold m-5 text-center tracking-wide text-gray-700"
                        >
                            Homeowner Names Dashboard
                        </h1>

                        <!-- Explanation of CSV upload functionality -->
                        <div class="content flex flex-col gap-4 my-10">
                            <p class="text-xl">
                                Here the input is just show how you can upload a
                                CSV file.
                            </p>
                            <p class="text-xl">
                                Clicking "Upload CSV" will parse the data from a
                                CSV file and display it below.
                            </p>
                        </div>

                        <!-- File upload input and button -->
                        <div class="mb-4">
                            <input
                                type="file"
                                @change="handleFileUpload"
                                class="border p-3"
                            />
                            <button
                                @click="uploadFile"
                                class="bg-darkGrey text-white p-3 rounded ml-2 text-xl"
                            >
                                Upload CSV
                            </button>
                        </div>

                        <!-- Displaying parsed data -->
                        <div v-if="parsedData" class="mb-5 mt-8">
                            <h2 class="text-2xl font-bold mb-2">Parsed Data</h2>
                        </div>
                        <div
                            v-for="(person, index) in parsedData"
                            :key="index"
                            class="border p-2 mb-2"
                        >
                            <div v-if="person.title" class="font-bold">
                                {{ person.title }}
                            </div>
                            <div v-if="person.first_name">
                                First Name: {{ person.first_name }}
                            </div>
                            <div v-if="person.initial">
                                Initial: {{ person.initial }}
                            </div>
                            <div v-if="person.last_name">
                                Last Name: {{ person.last_name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
// Exporting the component
export default {
    // Initializing component data
    data() {
        return {
            parsedData: null,
            file: null,
        };
    },
    // Component methods
    methods: {
        // Method to handle file upload event
        handleFileUpload(event) {
            this.file = event.target.files[0];
        },
        // Method to upload file (mocked for now)
        async uploadFile() {
            // Mock upload for now
            const parsedData = [
                // Mock data for parsed CSV
                {
                    title: "Mr:",
                    first_name: "John",
                    initial: null,
                    last_name: "Smith",
                },
                {
                    title: "Mrs:",
                    first_name: "Jane",
                    initial: null,
                    last_name: "Smith",
                },
                {
                    title: "Mister:",
                    first_name: "John",
                    initial: null,
                    last_name: "Doe",
                },
                {
                    title: "Mr:",
                    first_name: "Bob",
                    initial: null,
                    last_name: "Lawblaw",
                },
                {
                    title: "Mr:",
                    first_name: null,
                    initial: null,
                    last_name: "Smith",
                },
                {
                    title: "Mr:",
                    first_name: "Craig",
                    initial: null,
                    last_name: "Charles",
                },
                {
                    title: "Mr:",
                    first_name: "M",
                    initial: null,
                    last_name: "Mackie",
                },
                {
                    title: "Mrs:",
                    first_name: "Jane",
                    initial: null,
                    last_name: "McMaster",
                },
                {
                    title: "Mr:",
                    first_name: "Tom",
                    initial: null,
                    last_name: "Staff",
                },
                {
                    title: "Mr:",
                    first_name: "John",
                    initial: null,
                    last_name: "Doe",
                },
                {
                    title: "Dr:",
                    first_name: "P",
                    initial: null,
                    last_name: "Gunn",
                },
                {
                    title: "Dr:",
                    first_name: null,
                    initial: null,
                    last_name: "Joe",
                },
                {
                    title: "Ms:",
                    first_name: "Claire",
                    initial: null,
                    last_name: "Robbo",
                },
                {
                    title: "Prof:",
                    first_name: "Alex",
                    initial: null,
                    last_name: "Brogan",
                },
                {
                    title: "Mrs:",
                    first_name: "Faye",
                    initial: null,
                    last_name: "Hughes-Eastwood",
                },
                {
                    title: "Mr:",
                    first_name: "F.",
                    initial: null,
                    last_name: "Fredrickson",
                },
            ];
            this.parsedData = parsedData;
        },
    },
};
</script>
