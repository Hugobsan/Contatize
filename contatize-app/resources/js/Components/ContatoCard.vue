<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
import '@mdi/font/css/materialdesignicons.css';

const props = defineProps({
    contato: {
        type: Object,
        required: true,
    },
});

const deleteForm = useForm({
    _method: 'delete',
});

const showContato = () => {
    router.visit(route('contatos.show', { id: props.contato.id }));
};

const deleteContato = () => {
    if (confirm('Tem certeza que deseja excluir este contato?')) {
        deleteForm.post(route('contatos.destroy', { id: props.contato.id }), {
            onFinish: () => {
                router.visit(route('contatos.index'));
            },
        });
    }
};
</script>

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
        <v-menu open-on-hover>
            <template v-slot:activator="{ props }">
                <v-btn icon v-bind="props">
                    <v-icon>mdi-dots-horizontal</v-icon>
                </v-btn>
            </template>
            <v-list>
                <v-list-item @click="showContato">
                    <v-list-item-title>Ver Contato</v-list-item-title>
                </v-list-item>
                <v-list-item @click="deleteContato">
                    <v-list-item-title>Excluir Contato</v-list-item-title>
                </v-list-item>
            </v-list>
        </v-menu>
    </div>
</template>

<style scoped>
.v-avatar {
    width: 50px;
    height: 50px;
}
</style>
