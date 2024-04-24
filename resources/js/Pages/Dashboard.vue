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
                        <div
                            class="content flex flex-col gap-4 my-10 justify-center items-center"
                        >
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
                        <div
                            class="mb-4 flex flex-row justify-center items-center"
                        >
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

<script setup>
import { ref } from "vue";
import { Head } from "@inertiajs/vue3";
import axios from "axios";
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

    data.forEach((line) => {
        if (line.includes("Mr and Mrs")) {
            const parts = line.trim().split(" and ");
            const lastName = parts[1].trim().split(" ").pop();
            parsedPeople.push({
                title: "Mr",
                first_name: "",
                last_name: lastName,
            });
            parsedPeople.push({
                title: "Mrs",
                first_name: "",
                last_name: lastName,
            });
        } else if (line.includes("&")) {
            const parts = line.trim().split(" & ");
            const lastName = parts[1].trim().split(" ").pop();
            parsedPeople.push({
                title: "Dr",
                first_name: "",
                last_name: lastName,
            });
            parsedPeople.push({
                title: "Mrs",
                first_name: "",
                last_name: lastName,
            });
        } else if (line.includes(" and ")) {
            const parts = line.trim().split(" and ");
            parts.forEach((part) => {
                const nameParts = part.trim().split(" ");
                const title = nameParts[0];
                const lastName = nameParts[nameParts.length - 1];
                let firstName = "";
                if (nameParts.length > 2) {
                    firstName = nameParts.slice(1, -1).join(" ");
                } else {
                    firstName = "";
                }
                parsedPeople.push({
                    title: title,
                    first_name: firstName,
                    last_name: lastName,
                });
            });
        } else {
            // Handle cases where only first name and last name are present
            const nameParts = line.trim().split(" ");
            if (nameParts.length === 2) {
                parsedPeople.push({
                    title: "",
                    first_name: "",
                    last_name: nameParts[1],
                });
            } else if (nameParts.length > 2) {
                const title = nameParts[0];
                const lastName = nameParts[nameParts.length - 1];
                let firstName = "";
                if (
                    nameParts.length > 3 &&
                    nameParts[1] === "&" &&
                    nameParts[2] !== ""
                ) {
                    firstName = nameParts.slice(2, -1).join(" ");
                } else {
                    firstName = nameParts[1];
                }
                parsedPeople.push({
                    title: title,
                    first_name: firstName,
                    last_name: lastName,
                });
            }
        }
    });

    return parsedPeople;
};
</script>

<script>
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        Head,
    },
};
</script>
