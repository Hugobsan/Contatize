<script setup>
import { ref, computed } from 'vue';
import ContatoCard from '../../Components/ContatoCard.vue';

const props = defineProps({
    contatos: {
        type: Array,
        required: true,
    },
});

// Ref para o termo de pesquisa
const searchTerm = ref('');

// Computed para filtrar os contatos com base no termo de pesquisa
const filteredContatos = computed(() => {
    if (!searchTerm.value) {
        return props.contatos;
    }
    return props.contatos.filter(contato =>
        contato.nome.toLowerCase().includes(searchTerm.value.toLowerCase()) ||
        contato.telefone.includes(searchTerm.value)
    );
});
</script>

<template>
    <div class="container mx-auto px-4">
        <!-- Campo de Pesquisa -->
        <div class="mb-4">
            <input
                v-model="searchTerm"
                type="text"
                placeholder="Pesquisar..."
                class="w-full p-2 border border-gray-300 rounded"
            />
        </div>

        <!-- Lista de Contatos -->
        <div class="grid grid-cols-1 gap-4">
            <ContatoCard
                v-for="contato in filteredContatos"
                :key="contato.id"
                :contato="contato"
            />
        </div>
    </div>
</template>
