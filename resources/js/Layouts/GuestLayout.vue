<script setup>
// import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <div
        class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-darkGrey"
    >
        <div class="p-6">
            <Link href="/">
                <!-- <ApplicationLogo class="w-20 h-20 fill-current text-gray-500" /> -->
                <img
                    src="https://assets-global.website-files.com/5e38423084bb96caf84a40ce/658d7d9c4205f2875438666e_street-group-logo-white.svg"
                    loading="lazy"
                    alt=""
                    class="logo"
                    width="300px"
                    height="300px"
                />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
