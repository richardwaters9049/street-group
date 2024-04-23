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
                        <div v-if="parsedData.length > 0" class="mb-5 mt-8">
                            <h2 class="text-2xl font-bold mb-2">Parsed Data</h2>
                            <div
                                v-for="(person, index) in parsedData"
                                :key="index"
                                class="border p-2 mb-2"
                            >
                                <div v-for="(value, key) in person" :key="key">
                                    <div v-if="value" class="font-bold">
                                        {{ key }}: {{ value }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        Head,
    },
    data() {
        return {
            parsedData: [],
            file: null,
        };
    },
    methods: {
        handleFileUpload(event) {
            this.file = event.target.files[0];
        },
        uploadFile() {
            let reader = new FileReader();
            reader.onload = (event) => {
                let csvData = event.target.result;
                this.parsedData = this.parseCsv(csvData);
            };
            reader.readAsText(this.file);
        },
        parseCsv(csvData) {
            let parsedData = [];

            let lines = csvData.split("\n");

            lines.forEach((line) => {
                let names = line.split("and");

                names.forEach((name) => {
                    let titleIndex = name.search(
                        /(Mr|Mrs|Ms|Dr)\s+&\s+(Mr|Mrs|Ms|Dr)/i
                    );
                    if (titleIndex !== -1) {
                        let titles = name.substring(titleIndex).split("&");
                        titles.forEach((title) => {
                            let person = {};
                            let nameParts = title.trim().split(" ");

                            if (nameParts.length > 1) {
                                person.last_name =
                                    nameParts[nameParts.length - 1];
                                person.title = nameParts[0];
                                person.first_name = nameParts
                                    .slice(1, -1)
                                    .join(" ");
                                person.initial = null;
                                parsedData.push(person);
                            }
                        });
                    } else {
                        let person = {};
                        let nameParts = name.trim().split(" ");

                        if (nameParts.length > 1) {
                            person.last_name = nameParts[nameParts.length - 1];
                            person.title = nameParts[0];
                            person.first_name = nameParts
                                .slice(1, -1)
                                .join(" ");
                            person.initial = null;
                            parsedData.push(person);
                        }
                    }
                });
            });

            return parsedData;
        },
    },
};
</script>
