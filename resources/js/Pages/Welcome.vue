<script setup>
import { Head, Link } from "@inertiajs/vue3";
import ApplicationLogo from "@/Components/ApplicationLogo.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});

function handleImageError() {
    document.getElementById("screenshot-container")?.classList.add("!hidden");
    document.getElementById("docs-card")?.classList.add("!row-span-1");
    document.getElementById("docs-card-content")?.classList.add("!flex-row");
    document.getElementById("background")?.classList.add("!hidden");
}
</script>

<template>
    <Head title="Welcome" />
    <!-- Add div with two buttons that are links to login or register.  -->
    <div
        class="bg-darkGrey flex flex-col gap-10 justify-center items-center h-screen"
    >
        <div
            class="link-container flex flex-col gap-10 w-1/2 items-center justify-center mt-10"
        >
            <ApplicationLogo width="450px" height="450px" class="p-4 m-4" />

            <div class="link-inner flex flex-row gap-40">
                <Link :href="route('login')">
                    <button
                        class="bg-white text-black text-xl rounded-md px-6 py-3 font-semibold w-full tracking-widest"
                    >
                        Login
                    </button>
                </Link>
                <Link :href="route('register')">
                    <button
                        class="bg-white text-black text-xl rounded-md px-6 py-3 font-semibold w-full tracking-widest"
                    >
                        Register
                    </button>
                </Link>
            </div>
        </div>
    </div>
</template>
