<script setup>
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import "@mdi/font/css/materialdesignicons.css";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    contato: {
        type: Object,
        required: true,
    },
});

const showContato = (contato) => {
    router.visit(route("contatos.show", { id: contato.id }));
};

const deleteContato = (contato) => {
    if (confirm("Tem certeza que deseja excluir este contato?")) {
        deleteForm.post(route("contatos.destroy", { id: contato.id }), {
            onFinish: () => {
                router.visit(route("contatos.index"));
            },
        });
    }
};
</script>

<style scoped>
.v-avatar {
    width: 50px;
    height: 50px;
}
</style>

<template>
    <div class="flex items-center p-4 bg-white shadow rounded-lg">
        <v-avatar size="48" class="mr-4">
            <template v-if="contato.imagem">
                <img :src="contato.imagem" alt="Imagem do contato" />
            </template>
            <template v-else>
                <v-icon>mdi-account-circle</v-icon>
            </template>
        </v-avatar>
        <div class="flex-grow">
            <div class="font-bold">{{ contato.nome }}</div>
            <div class="text-gray-500">{{ contato.telefone }}</div>
        </div>
        <v-menu offset-y>
            <template v-slot:activator="{ on, attrs }">
                <v-btn icon v-bind="attrs" v-on="on">
                    <v-icon>mdi-dots-horizontal</v-icon>
                </v-btn>
            </template>
            <v-list>
                <v-list-item @click="verContato">
                    <v-list-item-title>Ver Contato</v-list-item-title>
                </v-list-item>
                <v-list-item @click="excluirContato">
                    <v-list-item-title>Excluir Contato</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>
