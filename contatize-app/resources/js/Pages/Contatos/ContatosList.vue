<script setup>
import { router } from "@inertiajs/vue3";
import { ref, computed } from "vue";
import "@mdi/font/css/materialdesignicons.css";
import { useForm } from "@inertiajs/vue3";

const props = defineProps({
    contatos: Array,
});

const deleteForm = useForm({
    _method: "delete",
});

const headers = [
    { title: "Nome", value: "nome" },
    { title: "Telefone", value: "telefone" },
    { title: "Ações", value: "actions", sortable: false },
];

const search = ref("");

const filteredContatos = computed(() => {
    if (!search.value) {
        return props.contatos;
    }
    return props.contatos.filter(
        (contato) =>
            contato.nome.toLowerCase().includes(search.value.toLowerCase()) ||
            contato.telefone
                .toLowerCase()
                .includes(search.value.toLowerCase())
    );
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

<template>
    <v-data-table
        :headers="headers"
        :items="filteredContatos"
        item-key="id"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Hotéis</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-text-field
                    v-model="search"
                    append-icon="mdi-magnify"
                    label="Pesquisar"
                    single-line
                    hide-details
                ></v-text-field>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-btn small @click="showContato(item)" color="primary" class="mr-2">
                <v-icon small>mdi-eye</v-icon>
            </v-btn>
            <v-btn small @click="deleteContato(item)" color="error">
                <v-icon small>mdi-delete</v-icon>
            </v-btn>
        </template>
    </v-data-table>
</template>
