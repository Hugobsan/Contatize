<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";
import { useToast } from "vue-toastification";
import ContatosEdit from "./ContatosEdit.vue";

const props = defineProps({
    contato: {
        type: Object,
    },
});

const deleteForm = useForm({
    _method: "delete",
});

const deleteContato = () => {
    if (confirm("Tem certeza que deseja excluir este contato?")) {
        deleteForm.post(route("contatos.destroy", { id: props.contato.id }), {
            onFinish: () => {
                router.visit(route("contatos.index"));
            },
        });
    }
};
</script>

<template>
    <Head :title="contato.nome" />

    <AuthenticatedLayout>
        <div class="mt-2 flex justify-center">
            <div class="lg:w-2/3 w-full">
                <div class="px-2 py-2 bg-white shadow rounded-lg">
                    <div
                        class="flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-6 w-100"
                    >
                        <!-- Avatar -->
                        <div class="flex justify-center md:justify-start align-center">
                            <div class="w-28 h-28 border border-gray-200 rounded-full">
                                <template v-if="contato.imagem">
                                    <img
                                        :src="contato.imagem"
                                        alt="Imagem do contato"
                                        class="max-w-full h-full rounded-full"
                                    />
                                </template>
                                <template v-else>
                                    <v-icon size="30">mdi-account-circle</v-icon>
                                </template>
                            </div>
                        </div>

                        <!-- Nome e Ações -->
                        <div
                            class="flex flex-col flex-col items-center md:items-start space-y-2 md:space-y-0 md:space-x-4 flex-grow"
                        >
                            <h2 class="text-2xl font-bold text-gray-800">
                                {{ contato.nome }}
                            </h2>

                            <div
                                class="mt-4 md:mt-0 flex justify-end md:justify-end align-center md:align-end space-x-4"
                            >
                                <ContatosEdit :contato="contato" />
                                <v-btn
                                    class="font-medium rounded-md mx-2 px-4 py-2"
                                    color="error"
                                    dark
                                    @click="deleteContato"
                                >
                                    <v-icon>mdi-trash-can</v-icon>
                                </v-btn>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-2 flex justify-center">
            <div class="lg:w-2/3 w-full">
                <div class="px-4 py-2 bg-white shadow rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">
                        Detalhes
                    </h3>
                    <div class="flex flex-col space-y-1">
                        <div class="flex items-center space-x-2">
                            <v-icon class="text-gray-500">mdi-phone</v-icon>
                            <span class="text-gray-700"
                                >&nbsp;{{ contato.telefone }}</span
                            >
                        </div>
                        <div class="flex items-center space-x-2">
                            <v-icon class="text-gray-500">mdi-email</v-icon>
                            <a
                                :href="'mailto:' + contato.email"
                                class="text-blue-600 hover:underline"
                                >&nbsp;
                                {{ contato.email }}
                            </a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <v-icon class="text-gray-500">mdi-clock</v-icon>
                            <span class="text-gray-700"
                                >&nbsp; Última edição em
                                {{ contato.formatted_updated_at }}</span
                            >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
