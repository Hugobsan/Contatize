<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import ContatosList from "./ContatosList.vue";
import ContatosCreate from "./ContatosCreate.vue";

import axios from "axios";

const props = defineProps({
    contatos: {
        type: Array,
    },
});
</script>

<template>
    <Head title="Contatos" />

    <AuthenticatedLayout>
        <template #header>
            <div class="flex justify-between">
                <div>
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        Contatos
                    </h2>
                </div>
                <ContatosCreate />
            </div>
        </template>
        <div class="mt-1 flex justify-center">
            <div class="lg:w-2/3 w-full">
                <ContatosList :contatos="contatos" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>
