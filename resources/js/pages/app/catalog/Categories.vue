<script setup lang="ts">
import {
    categoryColumns,
    categoryDetailSchema,
    categoryFormSchema,
} from '@/config/category';
import DataTable from '@/components/data-table/DataTable.vue';
import { categoryColumnLabels } from '@/components/data-table/labels';
import Section from '@/components/Section.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import type {
    Category,
    CategoryForm,
    CategoryTable,
    Pagination,
} from '@/types';
import SheetForm from '@/components/data-table/SheetForm.vue';
import SheetDetails from '@/components/data-table/SheetDetails.vue';
import { ref } from 'vue';
import { router, useForm } from '@inertiajs/vue3';
import { computed } from 'vue';
import { route } from 'ziggy-js';
import axios from 'axios';
import { Button } from '@/components/ui/button';

const props = defineProps<{
    categories: CategoryTable[];
    pagination: Pagination;
    initialSearch?: string;
}>();

const isSheetOpen = ref(false);
const isFormOpen = ref(false);
const typeForm = ref<'edit' | 'create'>('edit');
const isLoadingDetails = ref(false);
const isLoadingForm = ref(false);
const fullProductData = ref<Category | null>(null);

const categoryForm = useForm<CategoryForm & { id?: number }>({
    id: undefined,
    name: '',
    description: '',
});

async function handleOpenSheet(category: CategoryTable) {
    isSheetOpen.value = true;
    isLoadingDetails.value = true;
    fullProductData.value = null;

    try {
        const res = await axios.get(
            route('app.catalog.categories.show', { category: category.id }),
        );
        fullProductData.value = res.data;
    } catch (error) {
        console.error('Error fetching category details:', error);
    } finally {
        isLoadingDetails.value = false;
    }
}

async function handleOpenForm(
    type: 'edit' | 'create',
    category?: CategoryTable,
) {
    categoryForm.clearErrors();
    categoryForm.reset();
    typeForm.value = type;
    isFormOpen.value = true;

    if (type === 'create') {
        categoryForm.id = undefined;
        return;
    }

    if (category && type === 'edit') {
        isLoadingForm.value = true;
        try {
            const res = await axios.get(
                route('app.catalog.categories.edit', { category: category.id }),
            );

            const dbData = res.data;
            categoryForm.id = dbData.id;
            categoryForm.name = dbData.name;
            categoryForm.description = dbData.description;
        } catch (error) {
            console.error('Error fetching category data for form:', error);
            isFormOpen.value = false;
        } finally {
            isLoadingForm.value = false;
        }
    }
}

function submitForm() {
    if (typeForm.value === 'edit' && categoryForm.id) {
        categoryForm.put(
            route('app.catalog.categories.update', {
                category: categoryForm.id,
            }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    isFormOpen.value = false;
                    categoryForm.reset();
                },
            },
        );
    } else {
        categoryForm.post(route('app.catalog.categories.store'), {
            preserveScroll: true,
            onSuccess: () => {
                isFormOpen.value = false;
                categoryForm.reset();
            },
        });
    }
}

const columns = computed(() =>
    categoryColumns({
        onOpenSheet: handleOpenSheet,
        onOpenForm: handleOpenForm,
        onDelete: (category: CategoryTable) => {
            if (confirm(`¿Eliminar categoría ${category.name}?`)) {
                router.delete(
                    route('app.catalog.categories.delete', {
                        category: category.id,
                    }),
                    {
                        preserveScroll: true,
                    },
                );
            }
        },
    }),
);
</script>

<template>
    <AppLayout module="Categorías">
        <Section>
            <DataTable
                :columns="columns"
                :pagination="pagination"
                :data="categories"
                :column-labels="categoryColumnLabels"
                search-placeholder="Buscar por nombre..."
                :initial-search="initialSearch"
            >
                <template #actions>
                    <Button @click="handleOpenForm('create')">
                        Nueva Categoría
                    </Button>
                </template>
            </DataTable>

            <SheetForm
                v-model:open="isFormOpen"
                :type="typeForm"
                :fields="categoryFormSchema"
                :form="categoryForm"
                :is-loading="isLoadingForm"
                :meta="{
                    title: {
                        edit: 'Editar Categoría',
                        create: 'Crear Categoría',
                    },
                    description: {
                        edit: 'Modifica los campos para actualizar la categoría.',
                        create: 'Rellena los campos para crear una nueva categoría.',
                    },
                }"
                @submit="submitForm"
            />

            <SheetDetails
                v-model:open="isSheetOpen"
                :data="fullProductData"
                :fields="categoryDetailSchema"
                :is-loading="isLoadingDetails"
                title="Detalles de la Categoría"
                description="Información detallada de la categoría."
            />
        </Section>
    </AppLayout>
</template>
