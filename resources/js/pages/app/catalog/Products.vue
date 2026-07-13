<script setup lang="ts">
import { computed, ref } from 'vue';
import {
    productColumns,
    productDetailFields,
    productFormSchema,
} from '@/config/product';
import { productColumnLabels } from '@/components/data-table/labels';
import type {
    Pagination,
    ProductForm,
    ProductTable,
    ProductWithRelations,
    SelectOption,
} from '@/types';
import AppLayout from '@/layouts/AppLayout.vue';
import Section from '@/components/Section.vue';
import DataTable from '@/components/data-table/DataTable.vue';
import SheetDetails from '@/components/data-table/SheetDetails.vue';
import SheetForm from '@/components/data-table/SheetForm.vue';
import { Button } from '@/components/ui/button';
import { route } from 'ziggy-js';
import axios from 'axios';
import { router, useForm } from '@inertiajs/vue3';

const props = defineProps<{
    products: ProductTable[];
    selects: {
        categories: SelectOption[];
        brands: SelectOption[];
        units: SelectOption[];
    };
    pagination: Pagination;
    initialSearch?: string;
}>();

const isSheetOpen = ref(false);
const isFormOpen = ref(false);
const typeForm = ref<'edit' | 'create'>('edit');
const isLoadingDetails = ref(false);
const isLoadingForm = ref(false);
const fullProductData = ref<ProductWithRelations | null>(null);

const productForm = useForm<Partial<ProductForm> & { id?: number }>({
    id: undefined,
    category_id: undefined,
    brand_id: undefined,
    unit_id: undefined,
    sku: '',
    name: '',
    description: '',
    sale_price: 0,
    minimum_stock: 0,
    image: null,
});

async function handleOpenSheet(product: ProductTable) {
    isSheetOpen.value = true;
    isLoadingDetails.value = true;
    fullProductData.value = null;

    try {
        const res = await axios.get(
            route('app.catalog.products.show', { product: product.id }),
        );
        fullProductData.value = res.data;
    } catch (error) {
        console.error('Error fetching product details:', error);
    } finally {
        isLoadingDetails.value = false;
    }
}

async function handleOpenForm(type: 'edit' | 'create', product?: ProductTable) {
    productForm.clearErrors();
    productForm.reset();
    typeForm.value = type;
    isFormOpen.value = true;

    if (type === 'create') {
        productForm.id = undefined;
        return;
    }

    if (product && type === 'edit') {
        isLoadingForm.value = true;
        try {
            const res = await axios.get(
                route('app.catalog.products.edit', { product: product.id }),
            );

            const dbData = res.data;
            productForm.id = dbData.id;
            productForm.category_id = dbData.category_id;
            productForm.brand_id = dbData.brand_id;
            productForm.unit_id = dbData.unit_id;
            productForm.sku = dbData.sku;
            productForm.name = dbData.name;
            productForm.description = dbData.description;
            productForm.sale_price = dbData.sale_price;
            productForm.minimum_stock = dbData.minimum_stock;
            productForm.image = dbData.image ?? null;
        } catch (error) {
            console.error('Error fetching product data for form:', error);
            isFormOpen.value = false;
        } finally {
            isLoadingForm.value = false;
        }
    }
}

function submitForm() {
    if (typeForm.value === 'edit' && productForm.id) {
        productForm.put(
            route('app.catalog.products.update', { product: productForm.id }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    isFormOpen.value = false;
                    productForm.reset();
                },
            },
        );
    } else {
        productForm.post(route('app.catalog.products.store'), {
            preserveScroll: true,
            onSuccess: () => {
                isFormOpen.value = false;
                productForm.reset();
            },
        });
    }
}

const columns = computed(() =>
    productColumns({
        onOpenSheet: (product: ProductTable) => handleOpenSheet(product),
        onOpenForm: (type, product: ProductTable) =>
            handleOpenForm(type, product),
        onDelete: (product: ProductTable) => {
            if (confirm(`¿Eliminar producto ${product.sku}?`)) {
                router.delete(
                    route('app.catalog.products.delete', {
                        product: product.id,
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
    <AppLayout module="Productos">
        <Section>
            <div class="absolute top-4 right-4 flex justify-end">
                <Button @click="handleOpenForm('create')">
                    Nuevo Producto
                </Button>
            </div>

            <DataTable
                :columns="columns"
                :pagination="pagination"
                :data="products"
                :column-labels="productColumnLabels"
                search-placeholder="Buscar por nombre..."
                :initial-search="initialSearch"
            />
        </Section>

        <SheetForm
            v-model:open="isFormOpen"
            :type="typeForm"
            :fields="productFormSchema(selects)"
            :form="productForm"
            :is-loading="isLoadingForm"
            :meta="{
                title: {
                    edit: 'Editar Producto',
                    create: 'Crear Producto',
                },
                description: {
                    edit: 'Modifica los campos para actualizar el producto.',
                    create: 'Rellena los campos para crear un nuevo producto.',
                },
            }"
            @submit="submitForm"
        />

        <SheetDetails
            v-model:open="isSheetOpen"
            :data="fullProductData"
            :fields="productDetailFields"
            :is-loading="isLoadingDetails"
            title="Detalles del Producto"
            description="Información detallada del producto."
        />
    </AppLayout>
</template>
