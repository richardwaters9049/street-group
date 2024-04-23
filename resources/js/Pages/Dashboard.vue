<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
import Papa from "papaparse";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";

const parsedData = ref([]);
const file = ref(null);

const handleFileUpload = (event) => {
    file.value = event.target.files[0];
};

const uploadFile = () => {
    let formData = new FormData();
    formData.append("csv_file", file.value);

    axios
        .post("/upload-csv", formData)
        .then((response) => {
            console.log(response.data);
            // Fetch parsed data after successful upload
            parseCSV(response.data.filename);
        })
        .catch((error) => {
            console.log(error.response);
            // Handle error response
        });
};

const parseCSV = (filename) => {
    axios
        .get(`/parse-csv/${filename}`)
        .then((response) => {
            parsedData.value = parseData(response.data);
        })
        .catch((error) => {
            console.error(error);
            // Handle error response
        });
};

const parseData = (data) => {
    let parsedPeople = [];

    data.forEach((name) => {
        // Check for multiple people separated by '&' and handle 'Dr' titles separately
        if (name.toLowerCase().includes("dr")) {
            const drNames = name.trim().split("&");
            drNames.forEach((drName) => {
                parsedPeople.push(parseName(drName.trim(), "Dr"));
            });
        } else {
            parsedPeople.push(parseName(name.trim()));
        }
    });

    return parsedPeople.filter((person) => Object.keys(person).length !== 0);
};

const parseName = (name, defaultTitle = "") => {
    const matches = name.match(
        /\b(?<title>Dr|Mr|Mrs|Ms|Prof)\b(?:\s+(?<first>[A-Za-z]+(?:\s+[A-Za-z]+)?)\s+(?<last>[A-Za-z]+))?/i
    );

    if (matches && matches.groups) {
        const { title, first, last } = matches.groups;

        // Construct person object
        return {
            title: title || defaultTitle,
            first_name: first ? first.trim() : null,
            last_name: last ? last.trim() : null,
        };
    } else {
        // If no match found, return an empty object
        return {};
    }
};
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
};
</script>
