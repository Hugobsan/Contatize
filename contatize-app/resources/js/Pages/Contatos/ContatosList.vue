<script setup>
import ContatoCard from "../../Components/ContatoCard.vue";

const props = defineProps({
    contatos: {
        type: Array,
        required: true,
    },
});
</script>

<style scoped>
.grid {
    gap: 16px;
}
</style>

<template>
    <div
        class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4"
    >
        <ContatoCard
            v-for="contato in contatos"
            :key="contato.id"
            :contato="contato"
        />
    </div>
</template>
