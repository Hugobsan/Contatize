<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, watch, onMounted } from "vue";
import { useToast } from "vue-toastification";

const dialog = ref(false);
const toast = useToast();

// Define os campos do formulário
const props = defineProps({
    contato: {
        type: Object,
        required: true,
    },
});

// Formulário para adicionar um novo contato
const form = useForm({
    nome: props.contato.nome,
    telefone: props.contato.telefone,
    email: props.contato.email,
    imagem: null,
});

// Armazena os erros do formulário
const errors = ref({});

const saveContato = () => {
    form.put(route("contatos.update", {id: props.contato.id}), {
        onSuccess: () => {
            dialog.value = false;
            form.reset();
            // Resetando imagem
            imagePreview.value = "";
            toast.success("Contato adicionado com sucesso!");
            errors.value = {}; // Limpar erros em caso de sucesso
        },
        onError: (errorResponse) => {
            // Formata os erros para o formato esperado pelo Vuetify
            errors.value = formatErrors(errorResponse);
            toast.error("Erro ao adicionar contato!");
        },
    });
};

watch(dialog, (value) => {
    if (!value) {
        form.reset();
        errors.value = {};
        imagePreview.value = "";
    }
});

const previewImage = (event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = (e) => {
            imagePreview.value = e.target.result;
        };
        reader.readAsDataURL(file);
        form.imagem = file; // Adiciona o arquivo ao campo imagem do formulário
    }
};

const imagePreview = ref("");

// Pré-carregar a imagem na montagem do componente
onMounted(() => {
    if (props.contato.imagem) {
        imagePreview.value = props.contato.imagem;
    }
});

const formatErrors = (errorResponse) => {
    const formattedErrors = {};
    for (const [field, message] of Object.entries(errorResponse)) {
        formattedErrors[field] = [message];
    }
    return formattedErrors;
};
</script>

<template>
    <div>
        <v-btn color="primary" @click="dialog = true"><v-icon >mdi-pencil</v-icon></v-btn>
        <v-dialog v-model="dialog" max-width="720px">
            <v-card>
                <v-card-title>Editar Contato</v-card-title>
                <v-card-text>
                    <v-form @submit.prevent="saveContato">
                        <div class="grid gap-4 sm:grid-cols-1 md:grid-cols-2">
                            <v-text-field
                                v-model="form.nome"
                                label="Nome"
                                required
                                :error-messages="errors.nome || []"
                            ></v-text-field>
                            <v-text-field
                                v-model="form.telefone"
                                label="Telefone"
                                v-mask="'(##) #####-####'"
                                required
                                :error-messages="errors.telefone || []"
                            ></v-text-field>
                            <v-text-field
                                v-model="form.email"
                                label="E-mail"
                                :error-messages="errors.email || []"
                            ></v-text-field>
                            <v-file-input
                                v-model="form.imagem"
                                label="Imagem"
                                accept="image/*"
                                @change="previewImage"
                                :error-messages="errors.imagem || []"
                            ></v-file-input>
                            <div
                                v-if="imagePreview"
                                class="md:col-span-2 flex justify-center align-center"
                            >
                                <div class="w-1/2">
                                    <img
                                        :src="imagePreview"
                                        alt="Pré-visualização"
                                        class="max-w-full h-auto"
                                    />
                                </div>
                            </div>
                        </div>
                        <v-btn type="submit" color="primary" class="mt-4"
                            >Salvar</v-btn
                        >
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>
    </div>
</template>
